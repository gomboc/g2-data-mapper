<?php

class G2_DataMapper_Identity_Field
{
	
	private $_comps = array();
	
	private $_name = null;
	
	
	function __construct( $name ) 
	{	
		$this->_name = $name;
	}
	
	
	function add( $operator, $value ) 
	{	
		$this->_comps[] = array( 'name' => $this->_name, 'operator' => $operator, 'value' => $value );
		
		return $this;
	}
	
	
	function getComps() 
	{ 	
		return $this->_comps; 
	}
	
	
	function getCompEq()
	{
		if ( !empty( $this->_comps ) ) {
			foreach ( $this->_comps as $comp ) {
				if ( $comp['operator'] == '=' ) {
					return $comp['value'];
				}
			}
		}
		
		return null;
	}
	
	
	function isIncomplete() 
	{ 
		return empty( $this->_comps ); 
	}
}