<?php 

if ( !defined( 'G2_DATAMAPPER_ROOT' ) ) {
	
	define( 'G2_DATAMAPPER_ROOT', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
	
	require( G2_DATAMAPPER_ROOT . 'DataMapper' . DIRECTORY_SEPARATOR . 'Autoloader.php' );
	
	G2_DataMapper_Autoloader::register();
}

class G2_DataMapper
{
	
	private static $_instance;
	
	private $_dbAdapter;
	
	
	public function __construct( $dbAdapter = null )
	{
		if ( !is_null( $dbAdapter ) ) {
			$this->setDbAdapter( $dbAdapter );
		}
	}
		
	/**
	 * @return G2_DataMapper
	 */
	public static function getInstance()
	{
		if ( empty( self::$_instance ) ) {
			self::$_instance = new G2_DataMapper();	
		}
		
		return self::$_instance;
	}
	
	
	public function getDbAdapter()
	{
		return $this->_dbAdapter;
	}
	
	/**
	 * @return G2_DataMapper
	 */
	public function setDbAdapter( $dbAdapter )
	{
		$this->_dbAdapter = $dbAdapter;
		
		return $this;
	}
} 