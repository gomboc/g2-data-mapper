<?php

class Model_Domain_UserTest extends PHPUnit_Framework_TestCase
{
	
	
	private $_user;	
	

    public function setUp()
    {   	    	
    	$this->_user = new Model_Domain_User();
    	
        parent::setUp();
    }
    
    
    public function tearDown()
    {
    	unset( $this->_user );
    	
    	parent::tearDown();
    }
    
    /**
	 * @group current
	 */
    public function testMagicCall()
    {
    	$name = 'Drasko';
    	
    	$this->assertInstanceOf( 'G2_DataMapper_Domain', $this->_user );
    	
    	$this->_user->setName( $name );
    	
    	$this->assertEquals( $name, $this->_user->getName() );
    }
}