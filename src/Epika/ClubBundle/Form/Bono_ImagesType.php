<?php

namespace Epika\ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Bono_ImagesType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('path', 'file', array('label' => 'Imagen',
					'attr' => array(
							'size' => 50
							)))
		;
	}

	public function getDefaultOptions(array $options)
	{
		return array(
				'data_class' => 'Epika\ClubBundle\Entity\Bono_Images'
		);
	}

	public function getName()
	{
		return 'epika_clubbundle_bono_imagestype';
	}
}