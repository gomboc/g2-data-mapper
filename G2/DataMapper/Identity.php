<?php

class G2_DataMapper_Identity
{
	protected $_currentField = null;
	protected $_customContainer = array();
	protected $_fields = array();	
	protected $_limit = '';
	protected $_offset = '';
	protected $_orderBy = array();
	
	private $_enforce = array();
	
	public function __construct( $field = null, array $enforce = null ) 
	{	
		if ( !is_null( $enforce ) ) $this->__enforce = $enforce;		
		if ( !is_null( $field ) ) $this->field( $field );
	}
	
	public function eq( $value = null )
	{
		$this->_operator( "=", $value );
		return $this;
	}
	
	public function neq( $value = null )
	{
		$this->_operator( "<>", $value );
		return $this;
	}
	
	public function enforceField( $fieldname ) 
	{
		if ( !in_array( $fieldname, $this->_enforce ) && !empty( $this->__enforce ) ) {
			$forcelist = implode(', ', $this->__enforce);
			throw new Exception("{$fieldname} not a legal field ($forcelist)");
		}
	}
	
	public function field( $fieldname ) 
	{
		if ( !$this->isVoid() && $this->_currentField->isIncomplete() ) throw new Exception( "Incomplete field" );
		
		$this->enforceField( $fieldname );
		
		if ( isset($this->_fields[$fieldname]) ) $this->_currentField=$this->_fields[$fieldname];
		else {
			$this->_currentField = new G2_DataMapper_Identity_Field( $fieldname );
			$this->_fields[$fieldname]=$this->_currentField;
		}
		return $this;
	}
	
	public function gt( $value = null)
	{
		$this->_operator( ">", $value );
		return $this;
	}
	
	public function getComps() 
	{	
		$ret = array();
		foreach ( $this->_fields as $key => $field ) $ret = array_merge( $ret, $field->getComps() );
		return $ret;
	}
	
	public function getId( $fieldName )
	{		
		return isset( $this->_fields[$fieldName] ) ? $this->_fields[$fieldName]->getCompEq() : null;
	}
	
	public function getLimit() 
	{
		return $this->_limit;
	}
	
	public function getObjectFields() 
	{	
		return $this->__enforce;
	}
	
	public function getOffset() 
	{
		return $this->_offset;
	}
	
	public function getOrderBy() 
	{
		return $this->_orderBy;	
	}
	
	public function in( $array = array() )
	{		
		$this->_operator( "IN", '(' . join( ',', $array ) . ')' );
		return $this;
	}
	
	public function isVoid() 
	{
		return empty( $this->_fields );
	}
	
	public function lt( $value = null )
	{
		$this->_operator( "<", $value );
		return $this;
	}
	
	public function le( $value = null )
	{
		$this->_operator( "<=", $value );
		return $this;
	}
	
	public function ge( $value = null )
	{
		$this->_operator( ">=", $value );
		return $this;
	}
	
	public function setLimit( $value ) 
	{	
		$this->_limit = $value;	
		
		return $this;
	}
	
	public function setOffset($value) 
	{
		$this->_offset = $value;
	}
	
	public function setOrderBy( $param, $value ) 
	{	
		$this->_orderBy[$param] = $value;	
		
		return $this;
	}
	
	protected function _operator($symbol, $value) 
	{
		if ( $this->isVoid() ) throw new Exception("no object field defined");
		$this->_currentField->add( $symbol, $value );
		return $this;
	}
	
	public function __call( $name, $args )
	{
		$method = array();
		preg_match('~([a-z]+)(.*)~', $name, $method);

		switch ( $method[1] ) {
			case 'set' :
				$this->_customContainer[$method[2]] = $args[0];
				break;
			case 'get' :
				return isset( $this->_customContainer[$method[2]] ) ? $this->_customContainer[$method[2]] : null;
				break;
		}		
	}
}