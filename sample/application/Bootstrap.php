<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	
	protected function _initAutoload()
	{
		// Rewriting mapper basepath
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
        	'basePath'      => APPLICATION_PATH,
          	'namespace'     => '',
          	'resourceTypes' => array(
				'mappers' => array(
					'path'      => 'models/Mapper',
					'namespace' => 'Model_Mapper',
				),          
		)));
		
		$autoloader = Zend_Loader_Autoloader::getInstance();
		
		//Module autoloader
		$moduleAutoloader = new Zend_Application_Module_Autoloader(array(
			'namespace' => '', 
			'basePath' => APPLICATION_PATH
		));
		
		$autoloader->pushAutoloader( $moduleAutoloader );
	}
	

	protected function _initApp()
	{
	
	}

	
	protected function _initDbAdapter()
	{
		try {
			
			$dbAdapter = $this->getPluginResource( 'db' )->getDbAdapter();
		    $dbAdapter->getConnection();	    
		    			
		} catch ( Zend_Exception $e ) {		  
			
	     	throw new Exception( 'No database connection on your local mashine', 1101 );
		}	
	}
	
	
	protected function _initDataMapper()
	{
		require_once 'G2/DataMapper.php';
		
		$dataMapper = new G2_DataMapper( $this->getPluginResource( 'db' )->getDbAdapter() );
	}
}

