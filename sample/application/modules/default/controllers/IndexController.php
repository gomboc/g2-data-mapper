<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
       
    }

    public function indexAction()
    {				
		$mapper = new G2_DataMapper_Mapper(); 
		
		var_dump( $mapper );
    }


}