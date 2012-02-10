<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BonoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('long_description')
            ->add('information')
            ->add('conditions')
            ->add('image')
            ->add('price')
            ->add('discount')
            ->add('save')
            ->add('type')
            ->add('unpublish_date')
            ->add('is_active')
            ->add('category')
            ->add('company')
            ->add('membership')
            ->add('created_at')
            ->add('updated_at')
        ;
    }

    public function getName()
    {
        return 'epika_clubbundle_bonotype';
    }
}
