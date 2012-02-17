<?php

namespace Epika\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epika\ClubBundle\Entity\Membership;
use Epika\ClubBundle\Form\MembershipType;

/**
 * Membership controller.
 *
 * @Route("/membresia")
 */
class MembershipController extends Controller
{
    /**
     * Lists all Membership entities.
     *
     * @Route("/", name="membresia")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EpikaClubBundle:Membership')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Membership entity.
     *
     * @Route("/ver/{id}", name="membresia_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Membership')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membership entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Membership entity.
     *
     * @Route("/nueva", name="membresia_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Membership();
        $form   = $this->createForm(new MembershipType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Membership entity.
     *
     * @Route("/create", name="membresia_create")
     * @Method("post")
     * @Template("EpikaClubBundle:Membership:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Membership();
        $request = $this->getRequest();
        $form    = $this->createForm(new MembershipType(), $entity);
        $form->bindRequest($request);


        if ($form->isValid()) {
        	$entity->setCreatedAt(new \DateTime('now'));
        	$entity->setUpdatedAt(new \DateTime('now'));
        	$em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('membresia_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Membership entity.
     *
     * @Route("/editar/{id}", name="membresia_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Membership')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membership entity.');
        }

        $editForm = $this->createForm(new MembershipType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Membership entity.
     *
     * @Route("/{id}/update", name="membresia_update")
     * @Method("post")
     * @Template("EpikaClubBundle:Membership:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Membership')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membership entity.');
        }

        $editForm   = $this->createForm(new MembershipType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $entity->setUpdatedAt(new \DateTime('now'));
        	$em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('membresia_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Membership entity.
     *
     * @Route("/eliminar/{id}", name="membresia_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EpikaClubBundle:Membership')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Membership entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('membresia'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
