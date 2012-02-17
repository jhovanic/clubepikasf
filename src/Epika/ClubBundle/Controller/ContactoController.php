<?php

namespace Epika\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epika\ClubBundle\Entity\Contacto;

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

        return array(
            'entity'      => $entity,
        );
    }

}
