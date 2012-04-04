<?php

namespace Epika\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    /**
     * @Route("/index", name="default_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $categories = $em->getRepository('EpikaClubBundle:Category')->findAll();
	    if(sizeof($categories)>0) {    
        	$ids = array();
	        $ids[0] = rand(0,sizeof($categories)-1);
	        $ids[1] = rand(0,sizeof($categories)-2);
	        if($ids[0] == $ids[1])
	        	$ids[1] = $ids[0]+1;
	        $randCategories = array();
	        $randCategories[] = $categories[$ids[0]];
	        $randCategories[] = $categories[$ids[1]];
	    	return array('categories' => $randCategories);
	    }
	    return array('categories' => array());
    }
    
    /**
     * @Route("/login", name="default_login")
     * @Template()
     */
    public function loginAction()
    {
    	$request = $this->getRequest();
    	$session = $request->getSession();
    
    	// get the login error if there is one
    	if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
    		$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    	} else {
    		$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
    	}
    
    	return array(
    			// last username entered by the user
    			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
    			'error'         => $error
    	);
    }
    
}
