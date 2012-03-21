<?php

/*
 * This file is part of the CCDN ProfileBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 
 * 
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNUser\ProfileBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

use CCDNComponent\CommonBundle\Entity\Manager\EntityManagerInterface;

//use CCDNUser\ProfileBundle\EntityManager\ProfileManager;
//use CCDNUser\ProfileBundle\Form\Type\ProfileType;

/**
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class ProfileFormHandler
{	
	
	
	/**
	 *
	 * @access protected
	 */
	protected $factory;
	
	
	/**
	 *
	 * @access protected
	 */
	protected $container;
	
	
	/**
	 *
	 * @access protected
	 */
	protected $request;
	
	
	/**
	 *
	 * @access protected
	 */
	protected $manager;
	
	
	/**
	 *
	 * @access protected
	 */
	protected $options;
	
	
	/**
	 *
	 * @access protected
	 */
	protected $form;


	/**
	 *
	 * @access public
	 * @param FormFactory $factory, ContainerInterface $container, EntityManagerInterface $manager
	 */
	public function __construct(FormFactory $factory, ContainerInterface $container, EntityManagerInterface $manager)
	{
		$this->options = array();
		$this->factory = $factory;
		$this->container = $container;
		$this->manager = $manager;

		$this->request = $container->get('request');
	}
	
	
	/**
	 *
	 * @access public
	 * @param Array() $options
	 * @return $this
	 */
	public function setOptions(array $options = null )
	{
		$this->options = $options;
		
		return $this;
	}
	
	
	/**
	 *
	 * @access public
	 * @return bool
	 */
	public function process($profile)
	{			
		$this->options['profile'] = $profile;
		
		$this->getForm();
			
		if ($this->request->getMethod() == 'POST')
		{
			$this->form->bindRequest($this->request);
		
			//$formData = $this->form->getData();
			if ($this->form->isValid())
			{		
				$this->onSuccess($this->form->getData());
				
				return true;				
			}
		}

		return false;
	}
	
	
	/**
	 *
	 * @access public
	 * @return Form
	 */
	public function getForm()
	{
		if (!$this->form)
		{
			$profileType = $this->container->get('ccdn_user_profile.profile.form.type');
			$this->form = $this->factory->create($profileType, $this->options['profile']);
		}

		return $this->form;
	}
	
	
	/**
	 *
	 * @access protected
	 * @param $entity
	 * @return ProfileManager
	 */
	protected function onSuccess($entity)
    {
        $this->manager->update($entity)->flushNow();
    }
	
}