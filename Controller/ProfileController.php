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

namespace CCDNUser\ProfileBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\UserBundle\Model\UserInterface;
use CCDNUser\ProfileBundle\Repository\ProfileRepository;

/**
 * Deals with routes:
 * /user/my/profile
 * /user/{}/profile
 * /user/my/profile/edit
 * /user/{}/profile/edit
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class ProfileController extends ContainerAware
{
	
    /**
	 * /profile/my/profile
	 * /user/{user_id}/profile
     * Show a specific user by ID
 	 *
	 *
	 * @access public
	 * @param int $user_id
	 * @return RedirectResponse|RenderResponse
	 */
    public function showAction($user_id)
    {
		if ( ! $this->container->get('security.context')->isGranted('ROLE_USER'))
		{
			throw new AccessDeniedException('You do not have access to this section.');
		}
		
		if ( ! $user_id || $user_id == 0)
		{
			$user = $this->container->get('security.context')->getToken()->getUser();
		} else {
			$user = $this->container->get('ccdn_user_profile.profile.repository')->findOneByIdJoinedToUser($user_id);			
		}

		if ( ! is_object($user) || ! ($user instanceof UserInterface))
		{
            throw new AccessDeniedException('You do not have access to this section.');
        }

		$crumb_trail = $this->container->get('ccdn_component_crumb_trail.crumb_trail')
			->add($this->container->get('translator')->trans('crumbs.profile', array('%user_name%' => $user->getUsername()), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())), "user");
				
        return $this->container->get('templating')->
			renderResponse('CCDNUserProfileBundle:Profile:show.html.twig', array(
				'user' => $user,
				'crumbs' => $crumb_trail,
        ));
    }

	/**
	 * /profile/edit
	 * 
	 *
	 * @access public
	 * @param int $user_id
	 * @return RedirectResponse|RenderResponse
	 */
    public function editAction($user_id)
    {
		if ( ! $this->container->get('security.context')->isGranted('ROLE_USER'))
		{
			throw new AccessDeniedException('You do not have access to this section.');
		}
			
		$user = $this->container->get('security.context')->getToken()->getUser();
        
		if ( ! is_object($user) || ! $user instanceof UserInterface)
		{
            throw new AccessDeniedException('You do not have access to this section.');
        }

		// get the user associated profile
		$profile = $user->getProfile();

		// if the profile has no id then it
		// does not exist, so create one.
		if ( ! $profile->getId())
		{
			$this->container->get('ccdn_user_profile.profile.manager')->insert($profile)->flushNow();
		}
			
        $formHandler = $this->container->get('ccdn_user_profile.profile.form.handler');

        $process = $formHandler->process($profile);

        if ($process) {
			$this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('cc_profile_show', array('user_id' => $user->getId())));
        }
		
		$crumb_trail = $this->container->get('ccdn_component_crumb_trail.crumb_trail')
			->add($this->container->get('translator')->trans('crumbs.profile', array('%user_name%' => $user->getUsername()), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())), "user")
			->add($this->container->get('translator')->trans('crumbs.profile.edit', array(), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_edit', array('user_id' => $user->getId())), "edit");
				
        return $this->container->get('templating')->renderResponse(
            'CCDNUserProfileBundle:Profile:edit.html.twig',
            array(
				'form' => $formHandler->getForm()->createView(),
				'theme' => $this->container->getParameter('fos_user.template.theme'),
				'user' => $user,
				'crumbs' => $crumb_trail,
			));
    }
	
	
	/**
	 *
	 * @access protected
	 * @return string
	 */
	protected function setFlash($action, $value)
    {
        $this->container->get('session')->setFlash($action, $value);
    }

}