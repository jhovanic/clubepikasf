<?php

namespace Epika\ClubBundle\Twig\Extensions;
use Symfony\Component\DependencyInjection\ContainerInterface;


class UtilsExtensions extends \Twig_Extension
{
	public function getFunctions()
    {
        return array(
            'requireonce' => new \Twig_Function_Method($this, 'require_file'),
        	'setincludepath' => new \Twig_Function_Method($this, 'new_path')
        		);
    }
    
    public function new_path($text)
    {
    	return is_executable($text)? 'true':'false';
    }
    
    public function require_file($filename)
    {
    	require_once $filename;
    	return;
    }
    
    public function getName()
    {
    	return 'utils_extensions';
    }
    
}