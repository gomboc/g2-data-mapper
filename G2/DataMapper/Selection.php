<?php

class G2_DataMapper_Selection
{
	public function __construct() { }
	
	public function where( G2_DataMapper_Identity $obj = null) 
	{	
		if ( $obj->isVoid() ) return '1';		
		$compstrings = array();
		foreach ( $obj->getComps() as $comp ) {
			
			if ($comp['operator'] != 'IN') {

				if( $comp['value'] instanceof Zend_Db_Expr ) {
					$compstrings[] = "{$comp['name']} {$comp['operator']} {$comp['value']}";
				} else {
					$compstrings[] = "{$comp['name']} {$comp['operator']} '{$comp['value']}'";
				}
				
			} else {				
				$compstrings[] = "{$comp['name']} {$comp['operator']} {$comp['value']}";
			}
		}		
		$where = implode( " AND ", $compstrings );

		return $where;
	}
	
	public function orderBy( G2_DataMapper_Identity $obj = null ) 
	{	
		$orderByArr = $obj->getOrderBy();
	
		if ( is_null( $obj ) || empty( $orderByArr ) ) {
			return array();
		}	
		
		$result = array();	
		
		foreach ($orderByArr as $key => $value ) {
			$result[] = $key . ( strtolower( $value ) == 'desc' ? ' DESC' : ' ASC' );	
		}
		
		return $result;
	}

	public function limit( G2_DataMapper_Identity $obj = null ) 
	{	
		$limit = $obj->getLimit();
		
		if ( is_null( $obj ) || empty( $limit ) ) {
			return '';	
		}
		
		return $limit;
	}
}