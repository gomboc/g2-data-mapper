<?php 

class Model_Factory_Domain_UserTest extends PHPUnit_Framework_TestCase
{
	
	
	private $_factoryDomain;
	
	public function setUp()
	{		
		parent::setUp();
		
		$this->_factoryDomain = new Model_Factory_Domain_User();
	}
	
	/**
	 * @group current
	 */
	public function testCreateObject()
	{
		$data = array(
			'id' => 1,
			'name' => 'Drasko',
			'email' => 'email' 
		);
		
		$domain = $this->_factoryDomain->createObject( $data );
		
		$this->assertInstanceOf( 'Model_Domain_User', $domain );
		
		$this->assertEquals( $data, $domain->toArray() );
	}	
}