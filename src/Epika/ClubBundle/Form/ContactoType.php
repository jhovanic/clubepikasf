<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContactoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name',null,array('label' => 'Nombres'))
            ->add('last_name',null,array('label' => 'Apellidos'))
            ->add('cellphone','number',array('label' => 'Celular'))
            ->add('email','email',array('label' => 'Email'))
            ->add('photo','file',array('required' => false,
            		'label' => 'Foto',
            		'property_path' => false))
        ;
    }
    
    public function getDefaultOptions(array $options) 
    {
    	return array(
    			'data_class' => 'Epika\ClubBundle\Entity\Contacto'
    			);
    }

    public function getName()
    {
        return 'epika_clubbundle_contactotype';
    }
}
