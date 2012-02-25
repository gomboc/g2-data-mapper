<?php

class G2_DataMapper_Domain
{
	
	protected $_id;	
	
	protected $_mapper;	
	
	
	public function __construct( $id = null )
	{
		if ( !is_null( $id ) ) {
			$this->setId( $id );
		}
	}
	
	/**
	 * @return Model_Mapper
	 */				
	public function getMapper()
	{
		if ( !$this->isMapperInstance() ) {
			
			$mapperName = str_replace( 'Model_Domain', 'Model_Mapper_', get_class( $this ) );
			
			$this->_mapper = new $mapperName();
		}
		
		return $this->_mapper;
	}
	
	
	public function isMapperInstance( $mapper )
	{
		return !empty( $mapper ) && $mapper instanceof G2_DataMapper_Mapper;
	}
	

	public function markClean()
	{
		G2_DataMapper_Watcher::registerClean( $this );
	}
	
	
	public function markDelete()
	{
		G2_DataMapper_Watcher::registerDelete( $this );	
	}
	
	
	public function markDirty()
	{
		G2_DataMapper_Watcher::registerDirty( $this );		
	}	
	
	public function markNew()
	{
		G2_DataMapper_Watcher::registerNew( $this );	
	}
	
	/**
	 * @return G2_DataMapper_Domain
	 */
	public function saveDirty()
	{
		$mapper = $this->getMapper();
		
		if ( $this->isMapperInstance() ) {
			$mapper->update( $this );
		}		

		return $this;
	}
	
	/**
	 * @return G2_DataMapper_Domain
	 */
	public function saveNew()
	{
		$mapper = $this->getMapper();
		
		if ( $this->isMapperInstance() ) {
			$id = $mapper->insert( $this );
		}		

		if ( !is_null( $id ) ) {
			$this->setId( $id );
			G2_DataMapper_Watcher::add( $this );
		}

		return $this;
	}
	
	/**
	 * @return G2_DataMapper_Domain
	 */
	public function setFromArray( array $data )
	{
		if ( !empty( $data ) ) {
			
			foreach ( $data as $key => $value ) {
				
				if( !is_null( $value ) ) {
					$this->setProperty( $this->_getPropertyName( $key ), $value );
				}
			}
		}
		
		return $this;
	}
	
	/**
	 * @return G2_DataMapper_Domain
	 */
	public function setFormData( Zend_Form $form )
	{
		if ( !$form->valid() ) {
			throw new Exception( 'Form not valid', 1001 );
		} 
		
		$this->setFromArray( $form->getValues() );
		
		return $this;
	}

	public function setMapper( Model_Mapper $mapper )
	{
		$this->_mapper = $mapper;
		
		return $this;
	}
	
	/**
	 * @return G2_DataMapper_Domain
	 */
	public function setProperty( $property, $value ) 
	{	
		if ( property_exists( get_class( $this), $property ) ) {	
			$this->$property = $value;
		}
		
		return $this;
	}
	
	/**
	 * @return G2_DataMapper_Domain
	 */
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
	 * Setters and getters
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
	
	
	public function __isset( $name )
	{
		return key_exists( $name, get_object_vars( $this ) );
	}	
	
	
	private function _getPropertyName( $name )
	{
		$filter = new Zend_Filter_Word_UnderscoreToCamelCase();
		
		$property = $filter->filter( $name );
					
		$property[0] = strtolower( $property[0] );
		
		return '_' . $property;
	}
}