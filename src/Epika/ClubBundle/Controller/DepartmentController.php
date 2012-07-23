<?php

namespace Epika\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epika\ClubBundle\Entity\Department;

/**
 * Department controller.
 *
 * @Route("/departamentos")
 */
class DepartmentController extends Controller
{
    /**
     * Lists all Department entities.
     *
     * @Route("/", name="department")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EpikaClubBundle:Department')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Department entity.
     *
     * @Route("/ver/{id}", name="department_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Department')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Department entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}
