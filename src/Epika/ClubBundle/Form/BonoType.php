<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BonoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name',null,array('label' => 'Nombre',
            		'attr' => array(
            				'size' => 50
            				)))
            ->add('description',null,array('label' => 'Descripción',
            		'attr' => array(
            				'size' => 50
            				)))
            ->add('long_description',null,array('label' => 'Descripción Larga',
            		'attr' => array(
            				'style' => 'resize: none;',
            				'rows' => 4,
            				'cols' => 40
            				)))
            ->add('information',null,array('label' => 'Información',
            		'required' => false,
            		'attr' => array(
            				'style' => 'resize: none;',
            				'rows' => 4,
            				'cols' => 40
            				)))
            ->add('conditions',null,array('label' => 'Condiciones',
            		'attr' => array(
            				'style' => 'resize: none;',
            				'rows' => 4,
            				'cols' => 40
            				)))
            ->add('price','number',array('label' => 'Precio'))
            ->add('discount','number',array('label' => 'Descuento'))
            ->add('type','choice',array('label' => 'Tipo de Bono',
            		'choices' => array(
            				'0' => 'Ilimitado',
            				'1' => 'Mensual'
            				),
            		'empty_value' => 'Seleccione el tipo'))
            ->add('quantity', 'number', array('label' => 'Cantidad x Mes',
            		'required' => false))
            ->add('unpublish_date',null,array('label' => 'Fecha de Vencimiento',
            		'widget' => 'choice',
            		'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
            		'years' => range(date('Y'),date('Y')+5),
            		'months' => range(1,12),
            		'format' => 'yyyy - MMMM - dd',
            		'user_timezone' => 'America/Bogota',
            		'data_timezone' => 'America/Bogota'))
            ->add('company','entity',array('property' => 'name',
            		'label' => 'Compañia',
            		'class' => 'EpikaClubBundle:Company',
            		'multiple' => false,
            		'expanded' => false,
            		'empty_value' => 'Seleccione la Compañia'))
            ->add('membership','entity',array('property' => 'name',
            		'label' => 'Membresia',
            		'class' => 'EpikaClubBundle:Membership',
            		'multiple' => false,
            		'expanded' => false,
            		'empty_value' => 'Seleccione la membresia'))
            ->add('image1', 'file', array('label' => 'Imagen',
            		'property_path' => false,
            		'required' => false))
            ->add('image2', 'file', array('label' => 'Imagen',
            		'property_path' => false,
            		'required' => false))
            ->add('image3', 'file', array('label' => 'Imagen',
            		'property_path' => false,
            		'required' => false))
            ->add('image4', 'file', array('label' => 'Imagen',
            		'property_path' => false,
            		'required' => false))
        ;
    }

    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'Epika\ClubBundle\Entity\Bono'
    	);
    }
    
    public function getName()
    {
        return 'epika_clubbundle_bonotype';
    }
}
