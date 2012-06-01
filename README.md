G2 DataMapper
=============

G2 DataMapper is an object-relational mapper library written in PHP.

Contributors
------------

* [Draško Gomboc](https://github.com/gomboc)
* [Ivan Kričković](https://github.com/ivankoni)

Requirements
------------

* PHP 5.2 (or later) but PHP 5.3 (or later) is highly recommended.
* Zend Framework 1.9 (or later)

Install
-------

G2 DataMapper should be installed using the PEAR Installer, the backbone of the [PHP Extension and Application Repository](http://pear.php.net/) that provides a distribution system for PHP packages.

Depending on your OS distribution and/or your PHP environment, you may need to install PEAR or update your existing PEAR installation before you can proceed with the following instructions. `sudo pear upgrade PEAR` usually suffices to upgrade an existing PEAR installation. The [PEAR Manual ](http://pear.php.net/manual/en/installation.getting.php) explains how to perform a fresh installation of PEAR.

The following two commands (which you may have to run as `root`) are all that is required to install G2 DataMapper using the PEAR Installer:

    pear channel-discover gomboc.github.com/pear
    pear pear install g2/G2_DataMapper

After the installation you can find the G2 DataMapper source files inside your local PEAR directory; the path is usually `/usr/share/php/G2`.

Uninstall
---------

Remove package (run as root):

	$ pear uninstall g2/G2_DataMapper

Running Tests
-------------

To run the test suite you have to install [PHPUnit](https://github.com/sebastianbergmann/phpunit).

Run the unit tests with the following command:

	phpunit -c example/tests/unit/phpunit.xml

Documentation
-------------

Make sure than your local PEAR directory is in your include_path.

Add domain and mapper files to your project.
 .
    |-- application
       	|-- models
            |-- Domain
            |	`--User.php
            |-- Factory
            |	`-- Domain
            |		`-- User.php
            |-- Mapper
            	|--User.php
            	
Model_Domain_User

	<?php 
	
	class Model_Domain_User extends G2_DataMapper_Domain
	{
		
		protected $_email;
		
		protected $_name;
		
		protected $_lastName;
			
	}        
	
Model_Factory_Domain_User	

	<?php 
	
	class Model_Factory_Domain_User extends G2_DataMapper_Factory_Domain
	{
		
	}    	

Model_Mapper_User

	<?php 
	
	class Model_Mapper_User extends G2_DataMapper_Mapper
	{
		
		protected $_indentityField = 'id';
		
		protected $_table = 'user';
		
		protected $_columns = array(
			'name',
			'email'
		);
		
		
	}

Add to your Bootstrap file:

	require_once 'G2/DataMapper.php';
		
	new G2_DataMapper( $this->getPluginResource( 'db' )->getDbAdapter() );

Find one
	
	$mapper = new Model_Mapper_User(); 
		
	$identity = $mapper->getIdentity()->field( 'user.id' )->eq( 1 );
		
	$domain = $mapper->findOne( $identity );

Insert
		
	$domain = new Model_Domain_User();
	$domain->setName('ivan')->setEmail('gmail');
	
	$domain->saveNew();
		
