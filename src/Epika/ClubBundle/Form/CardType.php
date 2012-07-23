<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CardType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('number', null, array('label' => 'Número'))
            ->add('expiration_date',null,array('label' => 'Fecha de Vencimiento',
            		'widget' => 'choice',
            		'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
            		'years' => range(date('Y'),date('Y')+5),
            		'months' => range(1,12),
            		'format' => 'dd - MMMM - yyyy',
            		'user_timezone' => 'America/Bogota',
            		'data_timezone' => 'America/Bogota'))
            ->add('membership', 'entity', array('label' => 'Membresia',
            		'class' => 'EpikaClubBundle:Membership',
            		'empty_value' => 'Seleccione una Membresia',
            		'property' => 'name',
            		'multiple' => false,
            		'expanded' => false))
        ;
    }

    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'Epika\ClubBundle\Entity\Card'
    	);
    }
    
    public function getName()
    {
        return 'epika_clubbundle_cardtype';
    }
}
