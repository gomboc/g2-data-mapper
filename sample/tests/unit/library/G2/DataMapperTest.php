<?php

class G2_DataMapperTest extends PHPUnit_Framework_TestCase
{

	private $_zendDbAdapter;
	
	
    public function setUp()
    {   	    	
    	$this->_zendDbAdapter = new Zend_Db_Adapter_Pdo_Mysql( array(
		    'host'     => '127.0.0.1',
		    'username' => 'webuser',
		    'password' => 'xxxxxxxx',
		    'dbname'   => 'test'
		) );
    	
        parent::setUp();
    }
    
    
    public function testConst()
    {
    	$this->assertTrue( defined( 'G2_DATAMAPPER_ROOT' ) );
    	
    	$this->assertRegExp( '~\/G2\/$~', G2_DATAMAPPER_ROOT );   	
    }
    
    
    public function testContstruct()
    {
    	$dataMapper = new G2_DataMapper();
    	
    	$this->assertNull( $dataMapper->getDbAdapter() );
    	
    	$dataMapper = new G2_DataMapper( $this->_zendDbAdapter );
    	
    	$this->assertInstanceOf( 'Zend_Db_Adapter_Pdo_Mysql', $dataMapper->getDbAdapter() );
    	
    	$this->assertEquals( $this->_zendDbAdapter, $dataMapper->getDbAdapter() );
    }
    
    
	public function testInstance()
    {
    	$this->assertInstanceOf( 'G2_DataMapper', new G2_DataMapper() );
    	
    	$this->assertInstanceOf( 'G2_DataMapper', G2_DataMapper::getInstance() );
    }
    
    
 	public function testSetterAndGetter()
    {
    	$dataMapper = G2_DataMapper::getInstance()->setDbAdapter( $this->_zendDbAdapter );
    	
    	$this->assertEquals( $this->_zendDbAdapter, $dataMapper->getDbAdapter() );
    }
    
    public function testRequireAutoloader()
    {
    	$this->assertTrue( class_exists( 'G2_DataMapper_Autoloader' ) );
    }
}