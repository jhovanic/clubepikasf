<?php

namespace Epika\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
}
