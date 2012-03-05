<?php

	error_reporting( E_ALL | E_STRICT );
	ini_set( 'display_errors', 1 ); 
	
	date_default_timezone_set( 'Europe/Belgrade' ); 
	
	// Define path to application directory
	defined( 'APPLICATION_PATH' )
	    || define( 'APPLICATION_PATH', realpath( dirname( __FILE__ ) . '/../../application' ) );
	
	// Define application environment
	defined( 'APPLICATION_ENV' )
	    || define( 'APPLICATION_ENV', ( getenv( 'APPLICATION_ENV' ) ? getenv( 'APPLICATION_ENV' ) : 'testing' ) );
	
	// Ensure library/ is on include_path
	set_include_path( implode( PATH_SEPARATOR, array(
	    realpath( APPLICATION_PATH . '/../../' ), //just for DataMapper sample app
	    get_include_path(),
	) ) );
	
	require_once 'Zend/Loader/Autoloader.php';
	$autoloader = Zend_Loader_Autoloader::getInstance();
	
	//Module autoloader
	$moduleAutoloader = new Zend_Application_Module_Autoloader(array(
		'namespace' => '', 
		'basePath' => APPLICATION_PATH
	));
	
	$autoloader->pushAutoloader( $moduleAutoloader );
	
	$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
        	'basePath'      => APPLICATION_PATH,
          	'namespace'     => '',
          	'resourceTypes' => array(
				'mappers' => array(
					'path'      => 'models/Mapper',
					'namespace' => 'Model_Mapper',
				),          
		)));
		
	$autoloader->pushAutoloader( $resourceLoader );

	require_once 'G2/DataMapper.php';
