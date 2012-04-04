<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AfiliateType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('identification', null, array('label' => 'Cedula'))
            ->add('name', null, array('label' => 'Nombre'))
            ->add('last_name', null, array('label' => 'Apellido'))
            ->add('address', null, array('label' => 'Dirección'))
            ->add('neighborhood', null, array('label' => 'Barrio'))
            ->add('phone', null, array('label' => 'Teléfono'))
            ->add('cellphone', null, array('label' => 'Celular'))
            ->add('email', null, array('label' => 'Email'))
            ->add('gender', 'choice', array('label' => 'Sexo',
            		'choices' => array('Masculino' => 'Masculino',
            				'Femenino' => 'Femenino'),
            		'empty_value' => 'Seleccione su sexo'))
            ->add('birth_date', 'birthday', array('label' => 'Fecha de Nacimiento'))
            ->add('department', 'entity', array('class' => 'EpikaClubBundle:Department',
            		'property' => 'name',
            		'required' => false,
            		'label' => 'Departamento',
            		'empty_value' => 'Seleccione un Departamento',
            		'property_path' => false,
            		'multiple' => false,
            		'expanded' => false))
            ->add('city', 'entity', array('class' => 'EpikaClubBundle:City',
            		'property' => 'name',
            		'label' => 'Ciudad',
            		'empty_value' => 'Seleccione una Ciudad',
            		'multiple' => false,
            		'expanded' => false))
            ->add('ocupation', 'entity', array('class' => 'EpikaClubBundle:Ocupation',
            		'property' => 'name',
            		'label' => 'Ocupación',
            		'multiple' => false,
            		'expanded' => false))
            ->add('user', new UserType(), array('label' => 'Usuario'))
            ->add('card', new CardType(), array('label' => 'Tarjeta'))
        ;
    }

    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'Epika\ClubBundle\Entity\Afiliate'
    	);
    }
    
    public function getName()
    {
        return 'epika_clubbundle_afiliatetype';
    }
}
