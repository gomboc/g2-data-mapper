<?php

/**
 * @group domain
 */
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
    
    
    public function testIsset()
    {
    	$this->assertTrue( isset( $this->_user->name ) );

    	$this->_user->setName( 'Drasko' );
    	
    	$this->assertTrue( isset( $this->_user->name ) );	
    }
    

    public function testMagicCall()
    {
    	$lastName = 'Gomboc';
    	
    	$this->assertInstanceOf( 'G2_DataMapper_Domain', $this->_user );
    	
    	$this->_user->setLastName( $lastName );
    	
    	$this->assertEquals( $lastName, $this->_user->getLastName() );
    }
     

    public function testSetFromArray()
    {
    	$data = array (
    		'id' 		=> 2,
    		'name' 		=> null,
    		'last_name' => 'Gomboc'
    	);
    	
    	$this->_user->setFromArray( $data );
    	
    	unset( $data['name'] );
   	
    	$this->assertEquals( $data, $this->_user->toArray() );
    }
    
	
    public function testSetProperty()
    {
    	$name = 'Drasko';
    	
    	$this->_user->setProperty( 'name', $name );
    	
    	$this->assertEquals( $name, $this->_user->getName() );    	
    }
    
    
    public function testToArray()
    {
    	$data = array( 
    		'id' 		=> 1,
    		'name' 		=> 'Drasko',
    		'last_name' => 'Gomboc'
    	);
    	
    	$this->_user->setId( $data['id'] )
    				->setName( $data['name'] )
    				->setLastName( $data['last_name'] );
    	
    	$this->assertEquals( $data, $this->_user->toArray() );
    }
}