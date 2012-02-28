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
    
    
    public function testExtends()
    {
    	$this->assertInstanceOf( 'G2_DataMapper_Domain', $this->_user );	
    }
    
    
    public function testMagicCall()
    {
    	$email = 'drasko.gomboc@gmail.com';
    	
    	$this->_user->setEmail( $email );
    	
    	$this->assertEquals( $email, $this->_user->getEmail() );
    }
}