<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AfiliateType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('identification')
            ->add('name')
            ->add('last_name')
            ->add('address')
            ->add('neighborhood')
            ->add('phone')
            ->add('cellphone')
            ->add('email')
            ->add('gender', 'choice', array('label' => 'Sexo',
            		'choices' => array('Masculino' => 'Masculino',
            				'Femenino' => 'Femenino'),
            		'empty_value' => 'Seleccione su sexo'))
            ->add('birth_date')
            ->add('created_at')
            ->add('updated_at')
            ->add('department', 'entity', array('class' => 'EpikaClubBundle:Department',
            		'property' => 'name',
            		'label' => 'Departamento',
            		'property_path' => false,
            		'multiple' => false,
            		'expanded' => false))
            ->add('city', 'entity', array('class' => 'EpikaClubBundle:City',
            		'property' => 'name',
            		'label' => 'Ciudad',
            		'multiple' => false,
            		'expanded' => false))
            ->add('ocupation', 'entity', array('class' => 'EpikaClubBundle:Ocupation',
            		'property' => 'name',
            		'label' => 'Ocupación',
            		'multiple' => false,
            		'expanded' => false))
            ->add('user', new UserType())
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
