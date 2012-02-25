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
		if ( empty( $data ) ) {
			return null;
		}
		
		$domain = $this->_getDomainInstance();
	
		$domain->setFromArray( $data );
	
		return $domain;
	}
	
	/**
	 * @return G2_DataMapper_Domain
	 */
	private function _getDomainInstance()
	{
		$domain = str_replace( 'Model_Factory_', 'Model_', get_class( $this ) );
		
		return new $domain();
	}
}