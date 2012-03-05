<?php 

/**
 * @group collection
 */
class G2_DataMapper_CollectionTest extends PHPUnit_Framework_TestCase
{
	
	
	public $_data = array( 
		array( 
			'id' => 1,
			'name' => 'Drasko' 
		),
		array(
			'id' => 2,
			'name' => 'Gomboc'
		),
		array(
			'id' => 3,
			'name' => 'Drasko Gomboc'
		)
	);
	
	public $_collection;
	
	
	public function setUp()
	{
		$this->_collection = new G2_DataMapper_Collection( $this->_data, new Model_Factory_Domain_User() );
		
		parent::setUp();
	}
	
	
	public function tearDown()
	{
		unset( $this->_collection );
		
		parent::tearDown();
	}
	

	public function testAssociativeArrayData()
	{
		$data = array(
			'one' => array( 
				'id' => 1,
				'name' => 'Drasko'
			),
			'two' => array(
				'id' => 2,
				'name' => 'Gomboc'
			)
		);
		
		$collection  = new G2_DataMapper_Collection( $data, new Model_Factory_Domain_User() );
		
		$this->assertInstanceOf( 'Model_Domain_User', $collection->next() );
		
		$this->assertEquals( 2, $collection->current()->getId() );
	}
	
	
	public function testCount()
	{		
		$this->assertEquals( 3, count( $this->_collection ) );
		$this->assertEquals( 3, $this->_collection->count() );
		$this->assertEquals( 3, $this->_collection->getTotal() );
	}
	
	/**
	 * @group collection-iteration
	 */
	public function testIteration()
	{
		$domain = $this->_collection->current();
		
		$this->assertEquals( $this->_data[0], array( 'id' => $domain->getId(), 'name' => $domain->getName() ) );
		
//		$this->assertEquals( 0, $this->_collection->key() );
//		
//		$this->assertTrue( $this->_collection->valid() );
//		
//		
//		$domain = $this->_collection->next();
//		
//		$this->assertEquals( $this->_data[0], array( 'id' => $domain->getId(), 'name' => $domain->getName() ) );
//		
//		$this->assertEquals( 1, $this->_collection->key() );
//		
//		
//		$domain = $this->_collection->rewind();
//		
//		$this->assertEquals( 0, $this->_collection->key() );
	}
		
	
	public function testWithNoData()
	{
		$collection = new G2_DataMapper_Collection( null, new G2_DataMapper_Factory_Domain() );
		
		$this->assertEquals( array(), $collection->getRawData() );
		
		$this->assertInstanceOf( 'Iterator', $collection );
		
		$this->assertInstanceOf( 'Countable', $collection );
		
		foreach ( $collection as $domain ) {
		}
	}
	
	
	public function testWithRawData()
	{
		$data = array( 
			array( 
				'id' => 1,
				'name' => 'Drasko' 
			) 
		);
		
		$collection = new G2_DataMapper_Collection( $data, new Model_Factory_Domain_User() );
		
		$this->assertEquals( $data, $collection->getRawData() );
		
		foreach ( $collection as $domain ) {
			
			$this->assertInstanceOf( 'Model_Domain_User', $domain );
			
			$this->assertEquals( 1, $domain->getId() );
			
			$this->assertEquals( 'Drasko', $domain->getName() );
		}
	}
}