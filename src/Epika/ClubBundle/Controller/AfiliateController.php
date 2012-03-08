<?php

namespace Epika\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epika\ClubBundle\Entity\Afiliate;
use Epika\ClubBundle\Form\AfiliateType;
use Epika\ClubBundle\Entity\Afiliate_Bono;
use Epika\ClubBundle\Entity\Bono;

/**
 * Afiliate controller.
 *
 * @Route("/afiliado")
 */
class AfiliateController extends Controller
{
    /**
     * Lists all Afiliate entities.
     *
     * @Route("/", name="afiliado")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EpikaClubBundle:Afiliate')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Afiliate entity.
     *
     * @Route("/{id}/show", name="afiliado_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Afiliate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Afiliate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Afiliate entity.
     *
     * @Route("/new", name="afiliado_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Afiliate();
        $form   = $this->createForm(new AfiliateType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Afiliate entity.
     *
     * @Route("/create", name="afiliado_create")
     * @Method("post")
     * @Template("EpikaClubBundle:Afiliate:new.html.twig")
     */
    public function createAction()
    {
        $afiliate  = new Afiliate();
        $request = $this->getRequest();
        $form    = $this->createForm(new AfiliateType(), $afiliate);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $afiliate->setCreatedAt(new \DateTime('now'));
            $afiliate->setUpdatedAt(new \DateTime('now'));
            $afiliate->getUser()->setRole('usuario');
            $afiliate->getUser()->setIsActive(true);
            $afiliate->getUser()->setCreatedAt(new \DateTime('now'));
            $afiliate->getUser()->setUpdatedAt(new \DateTime('now'));
        	$em = $this->getDoctrine()->getEntityManager();
            $em->persist($afiliate);
            $em->flush();
            
            $bonos = $em->getRepository('EpikaClubBundle:Bono')->findAll();
            foreach ($bonos as $bono) {
            	$ab = new Afiliate_Bono();
            	$ab->setAfiliate($afiliate);
            	$ab->setBono($bono);
            	$ab->setIsActive($bono->getIsActive());
            	$em->persist($ab);
            	$em->flush();
            }

            return $this->redirect($this->generateUrl('afiliado_show', array('id' => $afiliate->getId())));
            
        }

        return array(
            'entity' => $afiliate,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Afiliate entity.
     *
     * @Route("/{id}/edit", name="afiliado_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Afiliate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Afiliate entity.');
        }

        $editForm = $this->createForm(new AfiliateType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Afiliate entity.
     *
     * @Route("/{id}/update", name="afiliado_update")
     * @Method("post")
     * @Template("EpikaClubBundle:Afiliate:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Afiliate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Afiliate entity.');
        }

        $editForm   = $this->createForm(new AfiliateType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('afiliado_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Afiliate entity.
     *
     * @Route("/{id}/delete", name="afiliado_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EpikaClubBundle:Afiliate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Afiliate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('afiliado'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
