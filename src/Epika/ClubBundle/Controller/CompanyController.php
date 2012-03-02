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
 * @Route("/company")
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
     * @Route("/{id}/show", name="company_show")
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
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Company entity.
     *
     * @Route("/new", name="company_new")
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
     * @Route("/{id}/edit", name="company_edit")
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
}