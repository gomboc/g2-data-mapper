<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
       
    }

    public function indexAction()
    {				
		$mapper = new Model_Mapper_User(); 
		
		$identity = $mapper->getIdentity()->field( 'user.id' )->eq( 1 );
		
		$domain = $mapper->findOne( $identity );

		var_dump( $domain );
    }


}