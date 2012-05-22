<?php 

class G2_DataMapper_Identity_FieldTest extends PHPUnit_Framework_TestCase
{
	
	private $_comps;
	
	private $_identityField;
	
	
	public function setUp()
	{		
		parent::setUp();
		
		$this->_comps = array( 
			'name' => 'email', 
			'operator' => '=', 
			'value' => 'drasko.gomboc' 
		);
		
		$this->_identityField = new G2_DataMapper_Identity_Field( $this->_comps['name'] );
	}
	
	
	public function tearDown()
	{
		unset( $this->_identityField, $this->_comps );
		
		parent::tearDown();
	}
	

	public function testComps()
	{	
		$this->_identityField->add( $this->_comps['operator'], $this->_comps['value'] );
		
		$this->assertEquals( array( $this->_comps ), $this->_identityField->getComps() );
		
		$comps = array( 
			'name' => 'email', 
			'operator' => '>', 
			'value' => 2 
		);
		
		$this->_identityField->add( $comps['operator'], $comps['value'] );
		
		$this->assertEquals( array( $this->_comps, $comps ), $this->_identityField->getComps() );
		
		$this->assertEquals( $this->_comps['value'], $this->_identityField->getCompEq() );
	}
	
	
	public function testIsIncomplete()
	{
		$this->assertTrue( $this->_identityField->isIncomplete() );
		
		$this->_identityField->add( '=', 'Drasko' );
		
		$this->assertFalse( $this->_identityField->isIncomplete() );
	}	
}