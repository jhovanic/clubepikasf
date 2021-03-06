<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name',null,array('label' => 'Nombre'))
            ->add('nit',null,array('label' => 'Nit'))
            ->add('address',null,array('label' => 'Dirección'))
            ->add('geoX',null,array('label' => 'Latitud'))
            ->add('geoY',null,array('label' => 'Longitud'))
            ->add('neighborhood',null,array('label' => 'Barrio'))
            ->add('email','email',array('label' => 'Email'))
            ->add('phone','number',array('label' => 'Teléfono'))
            ->add('cellphone','number',array('label' => 'Celular'))
            ->add('image','file',array('label' => 'Imagen',
            		'required' => false,
            		'property_path' => false))
            ->add('category','entity',array('class' => 'EpikaClubBundle:Category',
            		'property' => 'name',
            		'label' => 'Categoria',
            		'empty_value' => 'Seleccione una Categoria',
            		'multiple' => false,
            		'expanded' => false))
            ->add('department','entity',array('class' => 'EpikaClubBundle:Department',
            		'property' => 'name',
            		'label' => 'Departamento',
            		'empty_value' => 'Seleccione una Departamento',
            		'property_path' => false,
            		'multiple' => false,
            		'expanded' => false))
            ->add('city','entity',array('class' => 'EpikaClubBundle:City',
            		'property' => 'name',
            		'label' => 'Ciudad',
            		'empty_value' => 'Seleccione una Ciudad',
            		'multiple' => false,
            		'expanded' => false))
            ->add('contacto', new ContactoType())
            ->add('user', new UserType())
        ;
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'Epika\ClubBundle\Entity\Company'
    	);
    }

    public function getName()
    {
        return 'epika_clubbundle_companytype';
    }
}
