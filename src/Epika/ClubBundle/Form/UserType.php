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
            ->add('role')
            ->add('is_active')
            ->add('created_at')
            ->add('updated_at')
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
