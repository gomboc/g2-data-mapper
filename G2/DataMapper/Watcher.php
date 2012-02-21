<?php
/**
 * Identity Map and Unit Of Work design pattern
 * 
 */
class G2_DataMapper_Watcher
{
	
	private static $_instance;
	
	private $_all = array();
	
	private $_delete = array();
	
	private $_dirty = array();
	
	private $_new = array();
		
		
	private function __construct() { }
	
	/**
	 * @return G2_DataMapper_Watcher
	 */
	public static function getInstance()
	{
		if ( empty( self::$_instance ) ) {
			self::$_instance = new G2_DataMapper_Watcher();	
		}
		
		return self::$_instance;
	}
	
	
	public static function add( G2_DataMapper_Domain $obj )
	{
		$inst = self::getInstance();
		$inst->_all[$inst->globalKey( $obj )] = $obj;
	}
		

	public static function exists( $className, $id )
	{
		$inst = self::getInstance();
		$key = $className . $id;
		
		return isset($inst->_all[$key]) ? $inst->_all[$key] : null;
	}
	

	public static function getAll() 
	{
		$inst = self::getInstance();
		
		return $inst->_all;
	}
	

	public static function registerClean( G2_DataMapper_Domain $obj )
	{
		$inst = self::getInstance();
		
		unset($inst->_delete[$inst->globalKey( $obj )]);
		unset($inst->_dirty[$inst->globalKey( $obj )]);
				
		if( in_array( $obj, $inst->_new, true ) ) {
			$key = array_search( $obj, $inst->_new, true );
			unset( $inst->_new[$key] );
		}
	}
	

	public static function registerDelete( G2_DataMapper_Domain $obj )
	{
		$inst = self::getInstance();
		$inst->_delete[$inst->globalKey( $obj )] = $obj;
	}
	
	
	public static function registerDirty( G2_DataMapper_Domain $obj )
	{
		$inst = self::getInstance();
		$inst->_dirty[$inst->globalKey( $obj )] = $obj;
	}
	

	public static function registerNew( G2_DataMapper_Domain $obj )
	{
		$inst = self::getInstance();
		if( !in_array( $obj, $inst->_new, true ) ) $inst->_new[] = $obj;
	}
	

	public static function commit()
	{
		$inst = self::getInstance();
		$result = array();

		if ( !empty( $inst->_new ) ) {
			foreach ( $inst->_new as $key => $obj ) {
				$mapper = $obj->getMapper();
				if ( !empty( $mapper ) ) {
					$id = $mapper->insert( $obj );
					
					$result['insert'][] = array(
						'response' => $id,
						'mapper' => $mapper,
						'obj' => $obj
					);
				}							
				unset( $inst->_new[$key] );	
				$obj->setId( $id );
				G2_DataMapper_Watcher::add( $obj );
			}
		}
		
		if (!empty( $inst->_dirty )) { 
			foreach ( $inst->_dirty as $key => $obj ) {
				$mapper = $obj->getMapper();
				if ( !empty( $mapper ) ) {							
						$result['update'][] = array(
							'response' => $mapper->update( $obj ),
							'mapper' => $mapper,
							'obj' => $obj
						);							
				}	
				unset($inst->_dirty[$key]);	
			}
		}

		if ( !empty( $inst->_delete ) ) {
			foreach ( $inst->_delete as $key => $obj ) {
				$mapper = $obj->getMapper();
				if ( !empty( $mapper ) ) {
						$result['delete'][] = array(
							'response' => $mapper->delete( $obj ),
							'mapper' => $mapper,
							'obj' => $obj
						);
					}		
				unset($inst->_new[$key]);	
			}
		}				
		return $result;
	}
	

	private function globalKey( G2_DataMapper_Domain $obj )
	{
		return get_class( $obj ) . $obj->getId();
	}
	
}
