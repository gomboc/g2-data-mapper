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

Documentation
-------------

Make sure than your local PEAR directory is in your include_path.

Add domain and mapper files to your project.

 	.
    |-- application
    |  	|-- models
    |       |-- Domain
    |       |	`--User.php
    |       |-- Factory
    |       |	`-- Domain
    |       |		`-- User.php
    |       |-- Mapper
    |       	|--User.php
            	
Model_Domain_User

	class Model_Domain_User extends G2_DataMapper_Domain
	{

		protected $_email;
		
		protected $_name;
	}        
	
Model_Factory_Domain_User	

	class Model_Factory_Domain_User extends G2_DataMapper_Factory_Domain
	{
		
	}    	

Model_Mapper_User

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

findOne
	
	$mapper = new Model_Mapper_User(); 
	$identity = $mapper->getIdentity()->field( 'user.id' )->eq( 1 );
		
	$domain = $mapper->findOne( $identity );

insert
		
	$domain = new Model_Domain_User();
	$domain->setName('name')->setEmail('gmail');
	
	$domain->saveNew();

Development
-----------

To run the test suite you have to install [PHPUnit](https://github.com/sebastianbergmann/phpunit).

Run the unit tests with the following command:

	phpunit -c example/tests/unit/phpunit.xml
		
License
-------

Copyright (c) 2012 Draško Gomboc

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
