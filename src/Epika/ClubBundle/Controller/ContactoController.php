<?php

namespace Epika\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epika\ClubBundle\Entity\Contacto;
use Epika\ClubBundle\Form\ContactoType;

/**
 * Contacto controller.
 *
 * @Route("/contacto")
 */
class ContactoController extends Controller
{
    /**
     * Lists all Contacto entities.
     *
     * @Route("/", name="contacto")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EpikaClubBundle:Contacto')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Contacto entity.
     *
     * @Route("/{id}/show", name="contacto_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Contacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contacto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Contacto entity.
     *
     * @Route("/new", name="contacto_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Contacto();
        $form   = $this->createForm(new ContactoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Contacto entity.
     *
     * @Route("/create", name="contacto_create")
     * @Method("post")
     * @Template("EpikaClubBundle:Contacto:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Contacto();
        $request = $this->getRequest();
        $form    = $this->createForm(new ContactoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contacto_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Contacto entity.
     *
     * @Route("/{id}/edit", name="contacto_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Contacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contacto entity.');
        }

        $editForm = $this->createForm(new ContactoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Contacto entity.
     *
     * @Route("/{id}/update", name="contacto_update")
     * @Method("post")
     * @Template("EpikaClubBundle:Contacto:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Contacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contacto entity.');
        }

        $editForm   = $this->createForm(new ContactoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contacto_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Contacto entity.
     *
     * @Route("/{id}/delete", name="contacto_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EpikaClubBundle:Contacto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contacto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contacto'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
