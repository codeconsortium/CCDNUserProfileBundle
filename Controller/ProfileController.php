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
class ProfileController extends BaseController
{
    /**
     * Show a specific user by ID
     *
     * @access public
     * @param int $profileId
     * @return RenderResponse
     */
    public function showOverviewAction($profileId)
    {
        if ($this->container->getParameter('ccdn_user_profile.profile.show.requires_login') == 'true') {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new AccessDeniedException('You do not have access to this section.');
            }
        }

		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        $crumbs = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('ccdn_user_member.crumbs.members', array(), 'CCDNUserMemberBundle'),
				$this->container->get('router')->generate('ccdn_user_member_index', array()), "users")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI()), 'CCDNUserProfileBundle'), 
				$this->container->get('router')->generate('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())), "user");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:show_overview.html.' . $this->getEngine(), array(
            'profile' => $profile,
			'user' => $profile->getUser(),
            'crumbs' => $crumbs,
        ));
    }

    /**
     * Show a specific user by ID
     *
     * @access public
     * @param int $profileId
     * @return RenderResponse
     */
    public function showBioAction($profileId)
    {		
        if ($this->container->getParameter('ccdn_user_profile.profile.show.requires_login') == 'true') {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new AccessDeniedException('You do not have access to this section.');
            }
        }

		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());
		
        $crumbs = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('ccdn_user_member.crumbs.members', array(), 'CCDNUserMemberBundle'),
				$this->container->get('router')->generate('ccdn_user_member_index', array()), "users")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI()), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())), "user");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:show_bio.html.' . $this->getEngine(), array(
            'profile' => $profile,
			'user' => $profile->getUser(),
            'crumbs' => $crumbs,
        ));
    }

    /**
     *
     * @access public
     * @param int $profileId
     * @return RedirectResponse|RenderResponse
     */
    public function editPersonalAction($profileId)
    {	
		$this->checkIsAuthorised('ROLE_USER');
		
		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        //
        // Does the requested $user match our session user id? Or, are we an admin?
        //
        if ($profile->getUser()->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
        && ! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('You do not have access to this section.');
        }
		
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.profile_personal');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('ccdn_user_profile.flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())));
        }

        $crumbs = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('ccdn_user_member.crumbs.members', array(), 'CCDNUserMemberBundle'),
				$this->container->get('router')->generate('ccdn_user_member_index', array()), "users")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI()), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())), "user")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile.edit.personal', array(), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_edit_personal', array('profileId' => $profile->getId())), "edit");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:edit_personal.html.' . $this->getEngine(), array(
            'form' => $formHandler->getForm()->createView(),
            'profile' => $profile,
			'user' => $profile->getUser(),
            'crumbs' => $crumbs,
        ));
    }

    /**
     *
     * @access public
     * @param int $profileId
     * @return RedirectResponse|RenderResponse
     */
    public function editContactAction($profileId)
    {
		$this->checkIsAuthorised('ROLE_USER');
		
		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        //
        // Does the requested $user match our session user id? Or, are we an admin?
        //
        if ($profile->getUser()->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
        && ! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('You do not have access to this section.');
        }

        $formHandler = $this->container->get('ccdn_user_profile.form.handler.profile_contact');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('ccdn_user_profile.flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())));
        }

        $crumbs = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('ccdn_user_member.crumbs.members', array(), 'CCDNUserMemberBundle'),
				$this->container->get('router')->generate('ccdn_user_member_index', array()), "users")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI()), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())), "user")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile.edit.contact', array(), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_edit_contact', array('profileId' => $profile->getId())), "edit");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:edit_contact.html.' . $this->getEngine(), array(
            'form' => $formHandler->getForm()->createView(),
            'profile' => $profile,
			'user' => $profile->getUser(),
            'crumbs' => $crumbs,
        ));
    }

    /**
     *
     * @access public
     * @param int $profileId
     * @return RedirectResponse|RenderResponse
     */
    public function editAvatarAction($profileId)
    {
		$this->checkIsAuthorised('ROLE_USER');
		
		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        //
        // Does the requested $user match our session user id? Or, are we an admin?
        //
        if ($profile->getUser()->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
        && ! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('You do not have access to this section.');
        }

        $formHandler = $this->container->get('ccdn_user_profile.form.handler.profile_avatar');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('ccdn_user_profile.flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())));
        }

        $crumbs = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('ccdn_user_member.crumbs.members', array(), 'CCDNUserMemberBundle'),
				$this->container->get('router')->generate('ccdn_user_member_index', array()), "users")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI()), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())), "user")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile.edit.avatar', array(), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_edit_avatar', array('profileId' => $profile->getId())), "edit");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:edit_avatar.html.' . $this->getEngine(), array(
            'form' => $formHandler->getForm()->createView(),
            'profile' => $profile,
			'user' => $profile->getUser(),
            'crumbs' => $crumbs,
        ));
    }

    /**
     *
     * @access public
     * @param int $profileId
     * @return RedirectResponse|RenderResponse
     */
    public function editBioAction($profileId)
    {
		$this->checkIsAuthorised('ROLE_USER');
		
		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        //
        // Does the requested $user match our session user id? Or, are we an admin?
        //
        if ($profile->getUser()->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
        && ! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('You do not have access to this section.');
        }

        $formHandler = $this->container->get('ccdn_user_profile.form.handler.profile_bio');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('ccdn_user_profile.flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('ccdn_user_profile_show_bio_by_id', array('profileId' => $profile->getId())));
        }

        $crumbs = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('ccdn_user_member.crumbs.members', array(), 'CCDNUserMemberBundle'),
				$this->container->get('router')->generate('ccdn_user_member_index', array()), "users")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI()), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())), "user")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile.edit.bio', array(), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_edit_bio', array('profileId' => $profile->getId())), "edit");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:edit_bio.html.' . $this->getEngine(), array(
            'form' => $formHandler->getForm()->createView(),
            'profile' => $profile,
			'user' => $profile->getUser(),
            'crumbs' => $crumbs,
        ));
    }

    /**
     *
     * @access public
     * @param int $profileId
     * @return RedirectResponse|RenderResponse
     */
    public function editSignatureAction($profileId)
    {
		$this->checkIsAuthorised('ROLE_USER');
		
		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        //
        // Does the requested $user match our session user id? Or, are we an admin?
        //
        if ($profile->getUser()->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
        && ! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('You do not have access to this section.');
        }

        $formHandler = $this->container->get('ccdn_user_profile.form.handler.profile_signature');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('ccdn_user_profile.flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('ccdn_user_profile_show_bio_by_id', array('profileId' => $profile->getId())));
        }

        $crumbs = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('ccdn_user_member.crumbs.members', array(), 'CCDNUserMemberBundle'),
				$this->container->get('router')->generate('ccdn_user_member_index', array()), "users")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI()), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())), "user")
            ->add($this->container->get('translator')->trans('ccdn_user_profile.crumbs.profile.edit.signature', array(), 'CCDNUserProfileBundle'),
				$this->container->get('router')->generate('ccdn_user_profile_edit_signature', array('profileId' => $profile->getId())), "edit");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:edit_signature.html.' . $this->getEngine(), array(
            'form' => $formHandler->getForm()->createView(),
            'profile' => $profile,
			'user' => $profile->getUser(),
            'crumbs' => $crumbs,
        ));
    }
}
