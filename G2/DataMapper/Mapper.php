<?php

class G2_DataMapper_Mapper
{	

	protected $_db;	
	

	protected $_selection = null;
	

	protected $_identity = null;
	
	
	protected $_rawData = array();
	

	public function __construct()
	{		
//TODO: uopstiti registraciju db adaptera		
		//$this->_db = Zend_Controller_Front::getInstance()->getParam( 'bootstrap' )->getPluginResource( 'db' )->getDbAdapter();
	}
	

	public function delete( G2_DataMapper_Domain $obj = null ) {
//TODO: srediti ovo	
	}
	

	public function findAll( G2_DataMapper_Identity $identity )
	{	
		$this->_select( $identity );

		return $this->_returnCollection();		
	}
	

	public function findOne( G2_DataMapper_Identity $identity )
	{

		$domain = $this->_getFromMap( $identity );
		
		if ( !is_null( $domain ) ) {
			return $domain;
		}
				
		$this->_select( $identity );
	
		return $this->_returnDomain();
	}

	
	public function getIdentity()
	{
		if ( empty( $this->_identity ) ) {
			$this->_identity = new G2_DataMapper_Identity();
		}
		
		return $this->_identity;
	}
		

	public function insert( G2_DataMapper_Domain $obj )
	{
		$this->_rawData = $obj->toArray();
		
		$result = null;
		
		if ( !empty( $this->_rawData ) ) {
			
			$this->_filterData()
			 	 ->_addInsertDate()
			 	 ->_addUpdateDate();
			
			$this->_db->insert( $this->_table, $this->_rawData );
			$result = $this->_db->lastInsertId();
		}

		return $result;
	}
	
	
	public function update( G2_DataMapper_Domain $obj )
	{
//@todo srediti ovo
		$this->_rawData = $obj->toArray();
		
		$result = null;
		
		if ( !empty( $this->_rawData ) ) {
			
			$this->_filterData()
			 	 ->_addUpdateDate();
			 	 
			$where = 'id = ' . $this->_db->quote( $obj->getId() );
		
			$result = $this->_db->update( $this->_table, $this->_rawData, $where );
		}
		
		return $result;
	}
	

	protected function _getFactoryDomain() 
	{		
		$factoryName = str_replace( 'G2_DataMapper_Mapper_', 'G2_DataMapper_Factory_Domain_', get_class( $this ) );
	
		return new $factoryName();
	}
	
	
	protected function _getSelection()
	{
		if ( empty( $this->_selection ) ) {
			$this->_selection = new G2_DataMapper_Selection();
		}
		
		return $this->_selection;
	}
	
	
	protected function _returnCollection()
	{
		$collection = null;
		
		if ( count( $this->_rawData ) >= 1 ) {
			$collection = new G2_DataMapper_Collection( $this->_rawData, $this->_getFactoryDomain() );
		} 
				
		return $collection;
	}
	
	
	protected function _returnDomain()
	{
		$domain = null;
		
		if ( count( $this->_rawData ) == 1 ) {
			$domain = $this->_getFactoryDomain()->createObject( current( $this->_rawData ) );
		}

		return $domain;	
	}
	
	
	protected function _select( G2_DataMapper_Identity $identity = null )
	{
		$select = $this->_db->select()
						    ->from( $this->_table )
						    ->where( $this->_getSelection()->where( $identity ) )
						    ->order( $this->_getSelection()->orderBy( $identity ) );  
	  
		$this->_rawData = $this->_db->fetchAll($select);
	}
	
	
	private function _addInsertDate() {
		
		if ( in_array( 'ts_created', $this->_columns ) ) {
			$this->_rawData['ts_created'] = new Zend_Db_Expr('NOW()');	
		}
		
		return $this;
	}
	
	
	private function _addUpdateDate() {
		
		if ( in_array( 'ts_updated', $this->_columns ) ) {
			$this->_rawData['ts_updated'] = new Zend_Db_Expr('NOW()');	
		}
		
		return $this;
	}
	
	
	private function _filterData()
	{					
		$this->_rawData = array_intersect_key( $this->_rawData, array_flip( $this->_columns ) );
		
		return $this;
	}
	

	private function _getFromMap( G2_DataMapper_Identity $identity )
	{
		$id = $this->_getIdFromIdentity( $identity );
	
		$domainName = str_replace( 'G2_DataMapper_Mapper_', 'G2_DataMapper_Domain_', get_class( $this ) );
	
		return G2_DataMapper_Watcher::exists( $domainName, $id );
	}
	
	
	private function _getIdFromIdentity( G2_DataMapper_Identity $identity )
	{
		if ( is_array( $this->_indentityField ) ) {
			
			$idArr = array();
			
			foreach ( $this->_indentityField as $identityField ) {
				
				$idArr[] = $identity->getId( $identityField );
			}
			
			$id = join( '-', $idArr );
				
		} else {
			
			$id = $identity->getId( $this->_indentityField );
		}
		
		return $id;
	}

}