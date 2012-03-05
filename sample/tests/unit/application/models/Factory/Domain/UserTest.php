<?php 

class Model_Factory_Domain_UserTest extends PHPUnit_Framework_TestCase
{
	
	private $_factoryDomain;
	
	
	public function setUp()
	{		
		parent::setUp();
		
		$this->_factoryDomain = new Model_Factory_Domain_User();
	}
	
	
	public function tearDown()
	{
		unset( $this->_factoryDomain );
		
		parent::tearDown();
	}
	
	
	public function testCreateObject()
	{
		$data = array(
			'id' => 1,
			'name' => 'Drasko',
			'email' => 'email' 
		);
		
		$this->assertInstanceOf( 'G2_DataMapper_Factory_Domain', $this->_factoryDomain );
		
		$domain = $this->_factoryDomain->createObject( $data );
		
		$this->assertInstanceOf( 'Model_Domain_User', $domain );
		
		$this->assertEquals( $data, $domain->toArray() );
	}	
}