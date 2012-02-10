<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContactoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('last_name')
            ->add('cellphone')
            ->add('email')
            ->add('photo')
        ;
    }

    public function getName()
    {
        return 'epika_clubbundle_contactotype';
    }
}
