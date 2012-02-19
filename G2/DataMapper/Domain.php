<?php

class G2_DataMapper_Domain
{
	
	public $id;	
	
	protected $_mapper = null;	
	
	
	public function __construct( $id = null )
	{
		if ( !is_null( $id ) ) {
			
			$this->setId( $id );
		}
	}
	
				
	public function getMapper()
	{
		if ( empty( $this->_mapper ) ) {
			
			$mapperName = str_replace( 'Model_Domain_', 'Model_Mapper_', get_class( $this ) );
			
			$this->_mapper = new $mapperName();
		}
		
		return $this->_mapper;
	}
	
	public function markClean()
	{
		Model_Watcher::registerClean( $this );
		return $this;
	}
	
	public function markDelete()
	{
		Model_Watcher::registerDelete( $this );
		return $this;		
	}
	
	public function markDirty()
	{
		Model_Watcher::registerDirty( $this );
		return $this;		
	}	
	
	public function markNew()
	{
		Model_Watcher::registerNew( $this );	
		return $this;
	}
	
	public function saveDirty()
	{
		$mapper = $this->getMapper();
		
		if ( !empty( $mapper ) ) {
			$mapper->update( $this );
		}		

		return $this;
	}
	
	public function saveNew()
	{
		$mapper = $this->getMapper();
		
		if ( !empty( $mapper ) ) {
			$id = $mapper->insert( $this );
		}		

		if ( !is_null( $id ) ) {
			$this->setId( $id );
			Model_Watcher::add( $this );
		}

		return $this->id;
	}
	
	public function setFromArray( array $data )
	{
		$filter = new Zend_Filter_Word_UnderscoreToCamelCase();

		if ( !empty( $data ) ) {
			
			foreach ( $data as $key => $value ) {
				
				if( !is_null( $value ) ) {
					
					$property = lcfirst( $filter->filter( $key ) );
	
					$this->setProperty( $property, $value );
				}
			}
		}
		
		return $this;
	}
	
	public function setFormData( Zend_Form $form )
	{
		if ( !$form->valid() ) {
			throw new Exception( 'form not valid' );
		} 
		
		$this->setFromArray( $form->getValues() );
		
		return $this;
	}

	public function setMapper( Model_Mapper $mapper = null )
	{
		$this->_mapper = $mapper;
		return $this;
	}
	
	
	public function setProperty( $property, $value ) {
		
		if( property_exists( get_class( $this), $property ) ) {	
			$this->$property = $value;
		}
	}
	
	
	public function toArray()
	{
		$array = array();
		
		$vars = get_object_vars( $this );
		
        if ( !empty( $vars ) ) {
			
			$filter = new Zend_Filter_Word_CamelCaseToUnderscore();
			
			foreach ( $vars as $key => $value ) {
				
				if ( !is_null( $value ) ) {
					
					$array[strtolower( $filter->filter( $key ) ) ] = $value;
				} 
			}
		}
		
		return $array;
	}
			
	/**
	 * Magic call method
	 * Sets and returns object attributes
	 * 
	 * @param string $method
	 * @param array $args
	 */
	public function __call( $method, $args )
	{
		
        $methodType = substr( $method, 0, 3 );
        $paramName = strtolower( substr( $method, 3, 1 ) ) . substr( $method, 4 );
                  
        switch( $methodType ) {
            case 'set':
                $this->$paramName = current($args);                
                return $this;
                break;
            case 'get':
            	return isset( $this->$paramName ) ? $this->$paramName : null;
                break;
        }        
	}
	
	/**
	 * Magic isset method
	 * 
	 * @param string $name
	 */
	public function __isset( $name )
	{
		return key_exists( $name, get_object_vars( $this ) );
	}
	
}