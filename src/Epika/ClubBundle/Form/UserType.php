<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('login')
            ->add('password')
        ;
    }

    public function getDefaultOptions(array $options)
    {
    	return array(
    			'data_class' => 'Epika\ClubBundle\Entity\User'
    	);
    }
    
    public function getName()
    {
        return 'epika_clubbundle_usertype';
    }
}
