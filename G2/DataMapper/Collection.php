<?php

class G2_DataMapper_Collection implements Iterator, Countable
{
	/**
	 * @var unknown_type
	 */
	protected $_factoryDomain;
	
	/**
	 * 
	 * @var unknown_type
	 */
	protected $_raw = array();
	
	/**
	 * 
	 * @var unknown_type
	 */
	protected $_total = 0;
	
	/**
	 * 
	 * @var unknown_type
	 */
	private $_objects = array();
	
	/**
	 * @var unknown_type
	 */
	private $_pointer = 0;
	
	/**
	 * 
	 * @var unknown_type
	 */
	private $_result;
	
	
	public function __construct(array $raw = null, $factoryDomain = null)
	{
		if ( !is_null($raw) && !is_null($factoryDomain) ) {
			$this->_raw = $raw;
			$this->_total = count($raw);
		}

		$this->_factoryDomain = $factoryDomain;
		
	}
	
	
	public function count()
	{
		return $this->_total;
	}

	
	public function current()
	{
		return $this->_getRow($this->_pointer);
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
	
	
	public function next()
	{
		
		$row = $this->_getRow( $this->_pointer );

		if ( !empty($row) ) { 
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
		return !is_null($this->current());
	}


	private function _getRow( $num )
	{
	
		if ( $num >= $this->_total || $num < 0 ) {
			return null;
		}

		if ( isset($this->_objects[$num]) ) {
			return $this->_objects[$num];
		}

		if ( isset( $this->_raw[$num] ) ) {
			$this->_objects[$num] = $this->_factoryDomain->createObject($this->_raw[$num]);
			return $this->_objects[$num];
		}
		
		return null;
		
	}
}