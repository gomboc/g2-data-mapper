<?php 

	require_once( join( DIRECTORY_SEPARATOR, array( dirname( __FILE__ ), '../', 'G2', 'DataMapper.php' ) ) );

	$collection = new G2_DataMapper_Collection();
	
	$domain = new G2_DataMapper_Domain();
	
	$domain->setId( 101 );
	
	echo $domain->getId();
	
	$collection = new G2_DataMapper_Identity();
	
	$mapper = new G2_DataMapper_Mapper();
	
	$selection = new G2_DataMapper_Selection();
	
	$watcher = G2_DataMapper_Watcher::getInstance();
	
	$identityField = new G2_DataMapper_Identity_Field( 'name' );
	
	$factoryDomain = new G2_DataMapper_Factory_Domain();
	
	