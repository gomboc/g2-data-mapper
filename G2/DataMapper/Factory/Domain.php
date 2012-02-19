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
	 * @return G2_DataMapper_Domain
	 */	
	public function createObject( $data = array() )
	{
		
		$class = str_replace( 'G2_DataMapper_Factory_', 'G2_DataMapper_', get_class( $this ) );
		
		$domain = new $class();
		
		if ( empty( $data ) ) {
			return null;
		}
	
		$domain->setFromArray( $data );
	
		return $domain;
	}
}