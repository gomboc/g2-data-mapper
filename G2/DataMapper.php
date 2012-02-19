<?php 

if ( !defined( 'G2_DATAMAPPER_ROOT' ) ) {
	
	define( 'G2_DATAMAPPER_ROOT', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
	
	require( G2_DATAMAPPER_ROOT . 'DataMapper' . DIRECTORY_SEPARATOR . 'Autoloader.php' );
	
	G2_DataMapper_Autoloader::register();
}