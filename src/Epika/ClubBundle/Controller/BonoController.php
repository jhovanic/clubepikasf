<?php

namespace Epika\ClubBundle\Controller;

use Symfony\Component\Validator\Constraints\Date;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Epika\ClubBundle\Entity\Bono;
use Epika\ClubBundle\Entity\Bono_Images;
use Epika\ClubBundle\Entity\Afiliate;
use Epika\ClubBundle\Entity\Afiliate_Bono;
use Epika\ClubBundle\Form\BonoType;
use Epika\ClubBundle\Form\Bono_ImagesType;

/**
 * Bono controller.
 *
 * @Route("/bonos")
 */
class BonoController extends Controller
{
    /**
     * Lists all active Bono entities.
     *
     * @Route("/", name="bono")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EpikaClubBundle:Bono')->findBy(array('is_active' => true));

        return array('entities' => $entities);
    }
    
    /**
     * Lists all Bono entities.
     *
     * @Route("/admin", name="bono_admin")
     * @Template("EpikaClubBundle:Bono:index.html.twig")
     */
    public function indexAdminAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$entities = $em->getRepository('EpikaClubBundle:Bono')->findAll();
    	
    	return array('entities' => $entities);
    }
    
    /**
     * List all Bonos by Company
     * @Route("/comercio/{id}", name="bono_company")
     * @Template("EpikaClubBundle:Bono:index.html.twig")
     */
    public function indexByCompanyAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$entities = $em->getRepository('EpikaClubBundle:Bono')->findBy(array('company' => $id));
    	
    	return array('entities' => $entities);
    }

    /**
     * Finds and displays a Bono entity.
     *
     * @Route("/ver/{id}", name="bono_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EpikaClubBundle:Bono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bono entity.');
        }
        
        $conditions = explode("\n", $entity->getConditions());

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
        	'conditions' => $conditions,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Bono entity.
     *
     * @Route("/nuevo", name="bono_new")
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
        $bono  = new Bono();
        $request = $this->getRequest();
        $form    = $this->createForm(new BonoType(), $bono);
        $form->bindRequest($request);
        $now = date('Y').date('m').date('d').date('H').date('i').date('s');

        if ($form->isValid()) {
        	$bono->setSave($bono->getPrice()*($bono->getDiscount()/100));
        	$bono->setCategory($bono->getCompany()->getCategory());
        	$bono->setIsActive(true);
        	$bono->setCreatedAt(new \DateTime('now'));
        	$bono->setUpdatedAt(new \DateTime('now'));
        	$em = $this->getDoctrine()->getEntityManager();
        	$em->persist($bono);
        	$em->flush();
        	$bi = array();
            for ($i = 1; $i < 5 ; $i++) {
            	$bi[$i] = new Bono_Images();
            	$image = $form['image'.$i]->getData();
            	if ($image !== null && $image->isValid()){
            		$name = $i.$bono->getId().$now.'.'.$image->guessExtension();
            		$image->move($bi[$i]->getUploadRootDir(),$name);
            		$bi[$i]->setPath($name);
            		$bi[$i]->setThumb($name);
            		$bi[$i]->setBono($bono);
            		if ($form['screenshot'] !== null && $form['screenshot']->getData() == $i)
            			$bi[$i]->setScreenshot(true);
            		else
            			$bi[$i]->setScreenshot(false);
            		$bi[$i]->setCreatedAt(new \DateTime('now'));
            		$bi[$i]->setUpdatedAt(new \DateTime('now'));
            		$bono->addBono_Images($bi[$i]);
            		unset($image);
            	}
            }
            $em->flush();
            
            $afiliates = $em->getRepository('EpikaClubBundle:Afiliate')->findAll();
            foreach ($afiliates as $afiliate) {
            	$ab = new Afiliate_Bono();
            	$ab->setAfiliate($afiliate);
            	$ab->setBono($bono);
            	$ab->setIsActive($bono->getIsActive());
            	$ab->setQuantity($bono->getQuantity());
            	$em->persist($ab);
            	$em->flush();
            }
            

            return $this->redirect($this->generateUrl('bono_show', array('id' => $bono->getId())));
            
        }

        return array(
            'entity' => $bono,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Bono entity.
     *
     * @Route("/editar/{id}", name="bono_edit")
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
    	$now = date('Y').date('m').date('d').date('H').date('i').date('s');
    	
    	$em = $this->getDoctrine()->getEntityManager();

        $bono = $em->getRepository('EpikaClubBundle:Bono')->find($id);

        if (!$bono) {
            throw $this->createNotFoundException('Unable to find Bono entity.');
        }

        $editForm   = $this->createForm(new BonoType(), $bono);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
        	$bono->setSave($bono->getPrice()*($bono->getDiscount()/100));
        	$unpublishdate = $bono->getUnpublishDate()->getTimestamp();
        	$nowdate = date('Y-m-d');
        	$now = strtotime($nowdate);
        	if ($unpublishdate < $now)
        		$bono->setIsActive(false);
        	else 
        		$bono->setIsActive(true);
        	$bono->setUpdatedAt(new \DateTime('now'));
        	$em->persist($bono);
            $em->flush();
            
            $afbonos = $em->getRepository('EpikaClubBundle:Afiliate_Bono')->findBy(array('bono' => $bono->getId()));
            foreach ($afbonos as $afbono)
            {
            	$afbono->setQuantity($bono->getQuantity());
            	$afbono->setIsActive($bono->getIsActive());
            	$em->persist($afbono);
            	$em->flush();
            }

            return $this->redirect($this->generateUrl('bono_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $bono,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit images from an existing Bono entity.
     *
     * @Route("/editar/imagenes/{id}", name="bono_images")
     * @Template()
     */
    public function editImagesAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    
    	$entities = $em->getRepository('EpikaClubBundle:Bono_Images')->findBy(array('bono' => $id));

    	if (!$entities) {
    		throw $this->createNotFoundException('Bono no disponible.');
    	}
    	
    	$bono = $em->getRepository('EpikaClubBundle:Bono')->find($id);
    	$bi = new Bono_Images();
    	
    	$form   = $this->createForm(new Bono_ImagesType(), $bi);
    
    	return array(
    			'entities'    => $entities,
    			'bono' => $bono,
    			'form'   => $form->createView(),
    	);
    }
    
    /**
     * Uploads a new image for an existing Bono entity.
     *
     * @Route("/new/image/{id}", name="bono_images_new")
     * @Template("EpikaClubBundle:Bono:test.html.twig")
     */
    public function imagesNewAction($id) 
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	 
    	$bono = $em->getRepository('EpikaClubBundle:Bono')->find($id);
    	 
    	if(!$bono)
    		throw $this->createNotFoundException('Bono no disponible.');
    	
    	$bi  = new Bono_Images();
    	$request = $this->getRequest();
    	$form    = $this->createForm(new Bono_ImagesType(), $bi);
    	$form->bindRequest($request);
    	$now = date('Y').date('m').date('d').date('H').date('i').date('s');
    	
    	if ($form->isValid()) {
    		
    		$image = $form['path']->getData();
    		if ($image !== null && $image->isValid()){
    			$name = $bono->getId().$now.'.'.$image->guessExtension();
    			$image->move($bi->getUploadRootDir(),$name);
    			$bi->setPath($name);
    			$bi->setThumb($name);
    			$bi->setCreatedAt(new \DateTime('now'));
    			$bi->setUpdatedAt(new \DateTime('now'));
    			$bi->setBono($bono);
    			$bono->addBono_Images($bi);
    			unset($image);
    		}
    		
    		if ($bi->getScreenshot()) {
    			$actualsc = $em->getRepository('EpikaClubBundle:Bono_Images')->findOneBy(array('bono' => $bono->getId(), 'screenshot' => true));
    			$actualsc->setScreenshot(false);
    		}
    		
    		$em->persist($bi);
    		$em->flush();
    		$em->persist($bono);
    		$em->flush();
    		
    	}
    	
    	return $this->redirect($this->generateUrl('bono_images', array('id' => $bono->getId())));
    	
    }
    
    /**
     * Deletes an image from an existing Bono entity.
     *
     * @Route("/delete/image/{id}", name="bono_images_delete")
     * @Template()
     */
    public function imagesDeleteAction($id)
    {
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	$entity = $em->getRepository('EpikaClubBundle:Bono_Images')->find($id);
    	
    	if (!$entity) {
    		throw $this->createNotFoundException('Imagen no disponible.');
    	}
    	
    	$bono = $entity->getBono();
    	$actualsc = $entity->getScreenshot();
    	$entity->removeUploadedImage();
    	$em->remove($entity);
    	$em->flush();
    	
    	if ($actualsc) {
    		$bimages = $em->getRepository('EpikaClubBundle:Bono_Images')->findBy(array('bono' => $bono->getId()));
    		$bimages[0]->setScreenshot(true);
    		$em->persist($bimages[0]);
    		$em->flush();
    	}
    	
    	
    	return $this->redirect($this->generateUrl('bono_images', array('id' => $bono->getId())));
    }
    
    /**
     * Deletes an image from an existing Bono entity.
     *
     * @Route("/screenshot/image/{id}", name="bono_images_screenshot")
     * @Template()
     */
    public function imagesScreenshotAction($id)
    {
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	$entity = $em->getRepository('EpikaClubBundle:Bono_Images')->find($id);
    	 
    	if (!$entity) {
    		throw $this->createNotFoundException('Imagen no disponible.');
    	}
    	
    	$bimages = $em->getRepository('EpikaClubBundle:Bono_Images')->findBy(array('bono' => $entity->getBono()->getId()));
    	foreach ($bimages as $bimage) {
    		if ($bimage->getId() == $entity->getId()) 
    			$bimage->setScreenshot(true);
    		else 
    			$bimage->setScreenshot(false);
    		
    		$em->persist($bimage);
    		$em->flush();
    	}
    	
    	return $this->redirect($this->generateUrl('bono_images', array('id' => $entity->getBono()->getId())));

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
            
			$abs = $em->getRepository('EpikaClubBundle:Afiliate_Bono')->findAll();
			$bimages = $em->getRepository('EpikaClubBundle:Bono_Images')->findBy(array('bono' => $entity->getId()));
			foreach ($abs as $ab){
				if($ab->getBono()->getId() == $entity->getId())
					$em->remove($ab);
			}
			
			foreach ($bimages as $bimage) {
				$bimage->removeUploadedImage();
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
