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
	
	/**
	 * resets afiliate password
	 * @Route("/afiliados/reset/{id}", name="admin_afiliate_reset")
	 * @Template()
	 */
	public function resetPasswordAction($id)
	{
		if(false === $this->get('security.context')->isGranted('ROLE_ADMIN'))
			throw new AccessDeniedException();
		
		$em = $this->getDoctrine()->getEntityManager();
		$entity = $em->getRepository('EpikaClubBundle:Afiliate')->find($id);
		
		if (!$entity)
			$entity = $em->getRepository('EpikaClubBundle:Company')->find($id);
		
		if(!$entity)
			throw $this->createNotFoundException('Oops el Usuario no existe');
		
		$factory = $this->get('security.encoder_factory');
		$encoder = $factory->getEncoder($entity->getUser());
		$password = substr(md5(uniqid(null,true)),0,8);
		$entity->getUser()->setPassword($encoder->encodePassword($password, $entity->getUser()->getSalt()));
		$entity->setUpdatedAt(new \DateTime('now'));
		
		$em->persist($entity);
		$em->flush();
		
		$message = \Swift_Message::newInstance()
		->setSubject('Password Reset')
		->setFrom('info@clubepika.com')
		->setTo($entity->getEmail())
		->setBody($this->renderView('EpikaClubBundle:Email:passwordReset.html.twig', array('entity' => $entity, 'password' => $password)),'text/html')
		;
		$this->get('mailer')->send($message);
		
		return $this->redirect($this->generateUrl('admin_profile'));
		
	}
	
	
}