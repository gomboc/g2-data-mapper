<?php 

class G2_DataMapper_CollectionTest extends PHPUnit_Framework_TestCase
{
	
	
	public function setUp()
	{
		parent::setUp();
	}
	
	
	public function testImplements()
	{
		$collection = new G2_DataMapper_Collection();
		
		$this->assertInstanceOf( 'Iterator', $collection );
		
		$this->assertInstanceOf( 'Countable', $collection );
	}
}