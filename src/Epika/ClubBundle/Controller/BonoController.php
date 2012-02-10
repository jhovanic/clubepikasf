<?php

namespace Epika\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epika\ClubBundle\Entity\Bono;
use Epika\ClubBundle\Form\BonoType;

/**
 * Bono controller.
 *
 * @Route("/bono")
 */
class BonoController extends Controller
{
    /**
     * Lists all Bono entities.
     *
     * @Route("/", name="bono")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EpikaClubBundle:Bono')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Bono entity.
     *
     * @Route("/{id}/show", name="bono_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Bono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bono entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Bono entity.
     *
     * @Route("/new", name="bono_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Bono();
        $form   = $this->createForm(new BonoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Bono entity.
     *
     * @Route("/create", name="bono_create")
     * @Method("post")
     * @Template("EpikaClubBundle:Bono:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Bono();
        $request = $this->getRequest();
        $form    = $this->createForm(new BonoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bono_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Bono entity.
     *
     * @Route("/{id}/edit", name="bono_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Bono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bono entity.');
        }

        $editForm = $this->createForm(new BonoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Bono entity.
     *
     * @Route("/{id}/update", name="bono_update")
     * @Method("post")
     * @Template("EpikaClubBundle:Bono:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Bono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bono entity.');
        }

        $editForm   = $this->createForm(new BonoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bono_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Bono entity.
     *
     * @Route("/{id}/delete", name="bono_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EpikaClubBundle:Bono')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bono entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bono'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
