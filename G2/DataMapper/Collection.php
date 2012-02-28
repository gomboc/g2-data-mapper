<?php

class G2_DataMapper_Collection implements Iterator, Countable
{

	private $_factoryDomain;
	
	private $_objects = array();

	private $_pointer = 0;
	
	private $_raw = array();

	private $_result;
	
	private $_total = 0;
	
	
	public function __construct( array $raw = null, G2_DataMapper_Factory_Domain $factoryDomain )
	{		
		if ( !is_null( $raw ) ) {
			$this->_raw = $raw;
			$this->_total = count($raw);
		}

		$this->_factoryDomain = $factoryDomain;
	}
	
	
	public function count()
	{
		return $this->_total;
	}

	/**
	 * @return G2_DataMapper_Domain
	 */
	public function current()
	{
		return $this->_getRow( $this->_pointer );
	}
	
	
	public function getTotal()
	{
		return $this->_total;
	}
	
	
	public function getRawData()
	{
		return $this->_raw;	
	}
	
	
	public function key()
	{
		return $this->_pointer;
	}
	
	/**
	 * @return G2_DataMapper_Domain
	 */
	public function next()
	{
		$row = $this->_getRow( $this->_pointer );

		if ( !empty( $row ) ) { 
			$this->_pointer++; 
		}
		
		return $row;	
	}
	
	
	public function rewind()
	{
		$this->_pointer = 0;
		
		return $this;
	}
	
	
	public function valid()
	{
		return !is_null( $this->current() );
	}

	/**
	 * @return G2_DataMapper_Domain
	 */
	private function _getRow( $num )
	{
		if ( $num >= $this->_total || $num < 0 ) {
			return null;
		}

		if ( isset($this->_objects[$num]) ) {
			return $this->_objects[$num];
		}

		if ( isset( $this->_raw[$num] ) ) {
			$this->_objects[$num] = $this->_factoryDomain->createObject( $this->_raw[$num] );
			return $this->_objects[$num];
		}
		
		return null;
	}
}