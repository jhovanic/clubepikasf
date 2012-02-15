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
 * @Route("/membership")
 */
class MembershipController extends Controller
{
    /**
     * Lists all Membership entities.
     *
     * @Route("/", name="membership")
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
     * @Route("/{id}/show", name="membership_show")
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
     * @Route("/new", name="membership_new")
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
     * @Route("/create", name="membership_create")
     * @Method("post")
     * @Template("EpikaClubBundle:Membership:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Membership();
        $entity->setCreatedAt(new \DateTime('now'));
        $entity->setUpdatedAt(new \DateTime('now'));
        $request = $this->getRequest();
        $form    = $this->createForm(new MembershipType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('membership_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Membership entity.
     *
     * @Route("/{id}/edit", name="membership_edit")
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
     * @Route("/{id}/update", name="membership_update")
     * @Method("post")
     * @Template("EpikaClubBundle:Membership:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Membership')->find($id);
        $entity->setUpdatedAt(new \DateTime('now'));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membership entity.');
        }

        $editForm   = $this->createForm(new MembershipType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('membership_show', array('id' => $id)));
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
     * @Route("/{id}/delete", name="membership_delete")
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

        return $this->redirect($this->generateUrl('membership'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
