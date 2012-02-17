<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MembershipType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price','money',array('currency' => 'COP'))
            ->add('quantity','number')
        ;
    }
    
    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'Epika\ClubBundle\Entity\Membership'
    	);
    }

    public function getName()
    {
        return 'epika_clubbundle_membershiptype';
    }
}
