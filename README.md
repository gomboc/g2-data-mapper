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

Installation
------------

DataMapper should be installed using the PEAR Installer, the backbone of the [PHP Extension and Application Repository](http://pear.php.net/) that provides a distribution system for PHP packages.

Depending on your OS distribution and/or your PHP environment, you may need to install PEAR or update your existing PEAR installation before you can proceed with the following instructions. `sudo pear upgrade PEAR` usually suffices to upgrade an existing PEAR installation. The [PEAR Manual ](http://pear.php.net/manual/en/installation.getting.php) explains how to perform a fresh installation of PEAR.

The following two commands (which you may have to run as `root`) are all that is required to install DataMapper using the PEAR Installer:

    pear channel-discover gomboc.github.com/pear
    pear install g2/< to be decided >

After the installation you can find the DataMapper source files inside your local PEAR directory; the path is usually `/usr/share/php/< to be decided >`.

Running Tests
-------------

To run the test suite you have to install [PHPUnit](https://github.com/sebastianbergmann/phpunit).

Run the unit tests with the following command:

	phpunit -c example/tests/unit/phpunit.xml

Documentation
-------------
