<?php

class G2_DataMapper_Factory_Domain
{	
	/**
	 * Instatiate specific domain model object
	 * Populates obj properties with data from db
	 * 
	 * @param array $data
	 * @param boolean $domain - if it is called from child method (true)
	 * 
	 * @return Model_Domain
	 */	
	public function createObject( $data = array() )
	{
		
		$class = str_replace( 'Model_Factory_', 'Model_', get_class( $this ) );
		
		$domain = new $class();
		
		if ( empty( $data ) ) {
			return null;
		}
	
		$domain->setFromArray( $data );
	
		return $domain;
	}
}