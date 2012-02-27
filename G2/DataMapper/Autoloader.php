<?php 

class G2_DataMapper_Autoloader
{

	public static function register()
	{
		return spl_autoload_register( array( __CLASS__, 'autoload' ) );
	}
	
	public static function autoload( $class )
	{				
		if ( ( class_exists( $class ) ) || ( strpos( $class, 'G2_DataMapper' ) === false ) ) {
			return false;
		}
	
		$classFilePath = G2_DATAMAPPER_ROOT .
						 str_replace( '_', DIRECTORY_SEPARATOR , str_replace( 'G2_', '', $class ) ) .
						 '.php';
						 
		if ( ( file_exists( $classFilePath ) === false ) || ( is_readable( $classFilePath ) === false ) ) {
			return false;
		}
		
		require_once( $classFilePath );
	}

}