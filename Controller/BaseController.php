<?php

/*
 * This file is part of the CCDNUser ProfileBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNUser\ProfileBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use FOS\UserBundle\Model\UserInterface;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class BaseController extends ContainerAware
{
	/** @var $securityContext */
	private $securityContext;
	
	/** @var $profileManager */
	private $profileManager;
	
	/** 
	 * 
	 * @access protected
	 * @return SecurityContext
	 */
	protected function getSecurityContext()
	{
		if (null == $this->securityContext) {
			$this->securityContext = $this->container->get('security.context');
		}
		
		return $this->securityContext;
	}

	/** 
	 * 
	 * @access protected
	 * @return ProfileManager
	 */
	protected function getProfileManager()
	{
		if (null == $this->profileManager) {
			$this->profileManager = $this->container->get('ccdn_user_profile.manager.profile');
		}
		
		return $this->profileManager;
	}
	
	/** 
	 * 
	 * @access protected
	 * @throws AccessDeniedException
	 */
	protected function checkIsAuthorised($role)
	{
		if (! $this->getSecurityContext()->isGranted($role)) {
			throw new AccessDeniedException('You do not have permission to use this resource.');
		}
	}
	
    /**
     *
     * @access protected
	 * @param string $action, string $value
     * @return string
     */
    protected function setFlash($action, $value)
    {
        $this->container->get('session')->setFlash($action, $value);
    }

    /**
     *
     * @access protected
     * @return string
     */
    protected function getEngine()
    {
        return $this->container->getParameter('ccdn_user_profile.template.engine');
    }
}