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
    	$lastName = 'Gomboc';
    	
    	$this->assertInstanceOf( 'G2_DataMapper_Domain', $this->_user );
    	
    	$this->_user->setLastName( $lastName );
    	
    	$this->assertEquals( $lastName, $this->_user->getLastName() );
    }
}