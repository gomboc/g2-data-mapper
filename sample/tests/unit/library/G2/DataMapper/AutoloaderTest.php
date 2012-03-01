<?php 

class G2_DataMapper_AutoloaderTest extends PHPUnit_Framework_TestCase
{
	
	
	public function setUp()
	{
		parent::setUp();
	}
	
	
	public function testRegister()
	{		
		$this->assertTrue( in_array( array( 'G2_DataMapper_Autoloader', 'autoload' ), spl_autoload_functions() ) );
	}
	

	public function testAutoload()
	{
		G2_DataMapper_Autoloader::autoload( 'G2_DataMapper_Domain' );

		$domain = new G2_DataMapper_Domain();
		
		$this->assertInstanceOf( 'G2_DataMapper_Domain', $domain );
	}
	
	
	public function testAutoloadDifferentPrefix()
	{
		$response = G2_DataMapper_Autoloader::autoload( 'T3_DataMapper_Domain' );
		
		$this->assertFalse( $response );
	}
	
	
	public function testAutoloadExistingClass()
	{
		new G2_DataMapper_Domain();
		
		$response = G2_DataMapper_Autoloader::autoload( 'G2_DataMapper_Domain' );
		
		$this->assertFalse( $response );
	}
	
	
	public function testAutoloadFileExists()
	{
		$response = G2_DataMapper_Autoloader::autoload( 'G2_DataMapper_Domain2' );
		
		$this->assertFalse( $response );
	}
}