<?php 

class G2_DataMapper_CollectionTest extends PHPUnit_Framework_TestCase
{
	
	
	public function setUp()
	{
		parent::setUp();
	}
	
	
	public function testConstructWithNoData()
	{
		$collection = new G2_DataMapper_Collection( null, new G2_DataMapper_Factory_Domain() );
		
		$this->assertEquals( array(), $collection->getRawData() );
		
		foreach ( $collection as $domain ) {
		}
	}
	
	/**
	 * @group construct
	 */
	public function testConstructWithRawData()
	{
		$data = array( 
			array( 
				'id' => 1 
			) 
		);
		
		$collection = new G2_DataMapper_Collection( $data, new Model_Factory_Domain_User() );
		
		$this->assertEquals( $data, $collection->getRawData() );
		
		foreach ( $collection as $domain ) {
			
			$this->assertInstanceOf( 'Model_Domain_User', $domain );
			
			$this->assertEquals( 1, $domain->getId() );
		}
	}
	
	
	public function testImplements()
	{
		$collection = new G2_DataMapper_Collection( null, new G2_DataMapper_Factory_Domain() );
		
		$this->assertInstanceOf( 'Iterator', $collection );
		
		$this->assertInstanceOf( 'Countable', $collection );
	}
}