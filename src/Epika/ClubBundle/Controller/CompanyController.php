<?php

namespace Epika\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epika\ClubBundle\Entity\Company;
use Epika\ClubBundle\Entity\Contacto;
use Epika\ClubBundle\Form\CompanyType;

/**
 * Company controller.
 *
 * @Route("/comercios")
 */
class CompanyController extends Controller
{
    /**
     * Lists all Company entities.
     *
     * @Route("/", name="company")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EpikaClubBundle:Company')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Company entity.
     *
     * @Route("/ver/{id}", name="company_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Company')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView());
    }

    /**
     * Displays a form to create a new Company entity.
     *
     * @Route("/nuevo", name="company_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Company();
        $form   = $this->createForm(new CompanyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Company entity.
     *
     * @Route("/create", name="company_create")
     * @Method("post")
     * @Template("EpikaClubBundle:Company:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Company();
        $request = $this->getRequest();
        $form    = $this->createForm(new CompanyType(), $entity);
        $form->bindRequest($request);
        $entity->setCreatedAt(new \DateTime('now'));
        $entity->setUpdatedAt(new \DateTime('now'));
        $entity->getContacto()->setCreatedAt(new \DateTime('now'));
        $entity->getContacto()->setUpdatedAt(new \DateTime('now'));
        $image = $form['image']->getData();
        $photo = $form['contacto']['photo']->getData();
        $now = date('Y').date('m').date('d').date('H').date('i').date('s');
         

        if ($form->isValid()) {
            
        	if ($image !== null && $image->isValid()){
        		$name = $entity->getNit().$now.'.'.$image->guessExtension();
        		$image->move($entity->getUploadRootDir(),$name);
        		$entity->setImage($name);
        	}
        	 
        	if ($photo !== null && $photo->isValid()){
        		$name = $entity->getNit().$now.'.'.$photo->guessExtension();
        		$photo->move($entity->getContacto()->getUploadRootDir(),$name);
        		$entity->getContacto()->setPhoto($name);
        	}
        	
        	$em = $this->getDoctrine()->getEntityManager();
        	$roles = $em->getRepository('EpikaClubBundle:Role')->findAll();
        	foreach ($roles as $role){
        		if($role->getName() === 'ROLE_COMPANY')
        			$entity->getUser()->setRole($role);
        	}
        	$factory = $this->get('security.encoder_factory');
        	$encoder = $factory->getEncoder($entity->getUser());
        	$entity->getUser()->setPassword($encoder->encodePassword($entity->getNit(), $entity->getUser()->getSalt()));
        	$entity->getUser()->setIsActive(true);
        	$entity->getUser()->setCreatedAt(new \DateTime('now'));
        	$entity->getUser()->setUpdatedAt(new \DateTime('now'));

            $em->persist($entity);
            $em->persist($entity->getContacto());
            $em->flush();

            return $this->redirect($this->generateUrl('company_show', array('id' => $entity->getId())));
            
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Company entity.
     *
     * @Route("/editar/{id}", name="company_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Company')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        $editForm = $this->createForm(new CompanyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Company entity.
     *
     * @Route("/{id}/update", name="company_update")
     * @Method("post")
     * @Template("EpikaClubBundle:Company:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Company')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        $editForm   = $this->createForm(new CompanyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        $entity->setCreatedAt(new \DateTime('now'));
        $entity->setUpdatedAt(new \DateTime('now'));
        $entity->getContacto()->setCreatedAt(new \DateTime('now'));
        $entity->getContacto()->setUpdatedAt(new \DateTime('now'));
        $image = $editForm['image']->getData();
        $photo = $editForm['contacto']['photo']->getData();
        $now = date('Y').date('m').date('d').date('H').date('i').date('s');

        if ($editForm->isValid()) {
        if ($image !== null && $image->isValid()){
        		$name = $entity->getNit().$now.'.'.$image->guessExtension();
        		$image->move($entity->getUploadRootDir(),$name);
        		$entity->setImage($name);
        	}
        	 
        	if ($photo !== null && $photo->isValid()){
        		$name = $entity->getNit().$now.'.'.$photo->guessExtension();
        		$photo->move($entity->getContacto()->getUploadRootDir(),$name);
        		$entity->getContacto()->setPhoto($name);
        	}
        	$em->persist($entity);
        	$em->persist($entity->getContacto());
            $em->flush();

            return $this->redirect($this->generateUrl('company_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Company entity.
     *
     * @Route("/{id}/delete", name="company_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EpikaClubBundle:Company')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Company entity.');
            }

            $em->remove($entity);
            $em->remove($entity->getContacto());
            $em->flush();
        }

        return $this->redirect($this->generateUrl('company'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Activates a Bono from an Afiliate
     * 
     * @Route("/activar", name="company_activate")
     * @Template()
     */
    public function activarAction()
    {
    	$request = $this->getRequest();
    	$session = $request->getSession();
    	
    	if(false === $this->get('security.context')->isGranted('ROLE_COMPANY'))
    		throw new AccessDeniedException();
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	$company = $em->getRepository('EpikaClubBundle:Company')->findOneBy(array('user' => $this->get('security.context')->getToken()->getUser()->getId()));
    	$bonos = array();
    	
    	if($request->getMethod() === 'POST') {
	    	$afiliate = $em->getRepository('EpikaClubBundle:Afiliate')->findOneBy(array('identification' => $request->request->get('identification')));
	    	foreach ($afiliate->getBonos() as $bono)
	    	{
	    		if(($bono->getBono()->getCompany()->getId() == $company->getId()) && ($bono->getIsActive() === true))
	    		{
	    			$bonos[] = $bono->getBono();
	    		}
	    	}
	    	return array(
	    			'bonos' => $bonos,
	    			'afiliate' => $afiliate,
	    			'company' => $company
	    	);
    	}
    	
    	return array(
    			'company' => $company
    			);
    	
    }
    
    /**
     * Valida el bono y lo descuenta para el usuario
     * @Route("/validar/{id}/{aid}", name="company_validate")
     * @Method("get")
     * @Template()
     */
    public function validarAction($id, $aid)
    {
    	$request = $this->getRequest();
    	$session = $request->getSession();
    	
    	if(false === $this->get('security.context')->isGranted('ROLE_COMPANY'))
    		throw new AccessDeniedException();
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	$afiliate = $em->getRepository('EpikaClubBundle:Afiliate')->find($aid);
    	
    	if (!$afiliate) {
    		throw $this->createNotFoundException('Oops el Afiliado no existe');
    	}
    	
    	foreach ($afiliate->getBonos() as $afbono) {
    		if ($afbono->getBono()->getId() == $id) {
    			$afbono->setQuantity($afbono->getQuantity() - 1);
    			$afbono->setActivationDate(new \DateTime('now'));
    			if($afbono->getQuantity() <= 0)
    				$afbono->setIsActive(false);
    			$em->persist($afbono);
    			$em->flush();
    		}
    	}

    	$em->persist($afiliate);
    	$em->flush();
    	return $this->redirect($this->generateUrl('company_profile'));
    	
    }
    
    /**
     * Gets the profile of an afiliate
     * @Route("/perfil", name="company_profile")
     * @Template()
     */
    public function profileAction()
    {
    	if(false === $this->get('security.context')->isGranted('ROLE_COMPANY'))
    		throw new AccessDeniedException();
    	$em = $this->getDoctrine()->getEntityManager();
    	$company = $em->getRepository('EpikaClubBundle:Company')->findOneBy(array('user' => $this->get('security.context')->getToken()->getUser()->getId()));
    	return array(
    			'entity' => $company
    	);
    }
    
    
}
