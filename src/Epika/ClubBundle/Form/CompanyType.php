<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('nit')
            ->add('address')
            ->add('neighborhood')
            ->add('email')
            ->add('phone')
            ->add('cellphone')
            ->add('category')
            ->add('city')
            
        ;
    }

    public function getName()
    {
        return 'epika_clubbundle_companytype';
    }
}
