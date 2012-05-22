<?php 

class Model_Mapper_User extends G2_DataMapper_Mapper
{
	
	protected $_indentityField = 'id';
	
	protected $_table = 'user';
	
	protected $_columns = array(
		'name',
		'email'
	);
	
	
}