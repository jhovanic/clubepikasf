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
            ->add('price')
            ->add('quantity')
        ;
    }

    public function getName()
    {
        return 'epika_clubbundle_membershiptype';
    }
}
