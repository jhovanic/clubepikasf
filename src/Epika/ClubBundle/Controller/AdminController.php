<?php
namespace Epika\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Admin controller.
 *
 * @Route("/admin")
 */
class AdminController extends Controller
{
	
	/**
	 * Gets a Profile Panel for admins
	 * @Route("/perfil", name="admin_profile")
	 * @Template()
	 */
	public function profileAction()
	{
		if(false === $this->get('security.context')->isGranted('ROLE_ADMIN'))
			throw new AccessDeniedException();
		
		return array();
	}
	
}