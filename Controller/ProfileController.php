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

use CCDNUser\ProfileBundle\Controller\BaseController;

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
            $this->isAuthorised('ROLE_USER');
        }

		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI())), $this->path('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())));

        return $this->renderResponse('CCDNUserProfileBundle:Profile:show_overview.html.', array(
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
            $this->isAuthorised('ROLE_USER');
        }

		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());
		
        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI())), $this->path('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())));

        return $this->renderResponse('CCDNUserProfileBundle:Profile:show_bio.html.', array(
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
		$this->isAuthorised('ROLE_USER');
		
		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($profile->getUser()->getId() != $this->getUser()->getId()) {
	        $this->isAuthorised('ROLE_ADMIN');
        }
		
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.profile_personal');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->setFlash('notice', $this->trans('ccdn_user_profile.flash.profile.edit.success'));

            return $this->redirectResponse($this->path('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())));
        }

        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI())), $this->path('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())))
            ->add($this->trans('ccdn_user_profile.crumbs.profile.edit.personal'), $this->path('ccdn_user_profile_edit_personal', array('profileId' => $profile->getId())));

        return $this->renderResponse('CCDNUserProfileBundle:Profile:edit_personal.html.', array(
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
		$this->isAuthorised('ROLE_USER');
		
		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($profile->getUser()->getId() != $this->getUser()->getId()) {
            $this->isAuthorised('ROLE_ADMIN');
        }

        $formHandler = $this->container->get('ccdn_user_profile.form.handler.profile_contact');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->setFlash('notice', $this->trans('ccdn_user_profile.flash.profile.edit.success'));

            return $this->redirectResponse($this->path('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())));
        }

        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI())), $this->path('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())))
            ->add($this->trans('ccdn_user_profile.crumbs.profile.edit.contact'), $this->path('ccdn_user_profile_edit_contact', array('profileId' => $profile->getId())));

        return $this->renderResponse('CCDNUserProfileBundle:Profile:edit_contact.html.', array(
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
		$this->isAuthorised('ROLE_USER');
		
		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($profile->getUser()->getId() != $this->getUser()->getId()) {
            $this->isAuthorised('ROLE_ADMIN');
        }

        $formHandler = $this->container->get('ccdn_user_profile.form.handler.profile_avatar');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->setFlash('notice', $this->trans('ccdn_user_profile.flash.profile.edit.success'));

            return $this->redirectResponse($this->path('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())));
        }

        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI())), $this->path('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())))
            ->add($this->trans('ccdn_user_profile.crumbs.profile.edit.avatar'), $this->path('ccdn_user_profile_edit_avatar', array('profileId' => $profile->getId())));

        return $this->renderResponse('CCDNUserProfileBundle:Profile:edit_avatar.html.', array(
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
		$this->isAuthorised('ROLE_USER');
		
		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($profile->getUser()->getId() != $this->getUser()->getId()) {
            $this->isAuthorised('ROLE_ADMIN');
        }

        $formHandler = $this->container->get('ccdn_user_profile.form.handler.profile_bio');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->setFlash('notice', $this->trans('ccdn_user_profile.flash.profile.edit.success'));

            return $this->redirectResponse($this->path('ccdn_user_profile_show_bio_by_id', array('profileId' => $profile->getId())));
        }

        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI())), $this->path('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())))
            ->add($this->trans('ccdn_user_profile.crumbs.profile.edit.bio'), $this->path('ccdn_user_profile_edit_bio', array('profileId' => $profile->getId())));

        return $this->renderResponse('CCDNUserProfileBundle:Profile:edit_bio.html.', array(
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
		$this->isAuthorised('ROLE_USER');
		
		$profile = $this->getProfileManager()->getProfile($profileId, $this->getSecurityContext());

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($profile->getUser()->getId() != $this->getUser()->getId()) {
			$this->isAuthorised('ROLE_ADMIN');
        }

        $formHandler = $this->container->get('ccdn_user_profile.form.handler.profile_signature');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->setFlash('notice', $this->trans('ccdn_user_profile.flash.profile.edit.success'));

            return $this->redirectResponse($this->path('ccdn_user_profile_show_bio_by_id', array('profileId' => $profile->getId())));
        }

        $crumbs = $this->getCrumbs()
            ->add($this->trans('ccdn_user_profile.crumbs.profile', array('%user_name%' => $profile->getUsernameBDI())), $this->path('ccdn_user_profile_show_by_id', array('profileId' => $profile->getId())))
            ->add($this->trans('ccdn_user_profile.crumbs.profile.edit.signature'), $this->path('ccdn_user_profile_edit_signature', array('profileId' => $profile->getId())));

        return $this->renderResponse('CCDNUserProfileBundle:Profile:edit_signature.html.', array(
            'form' => $formHandler->getForm()->createView(),
            'profile' => $profile,
			'user' => $profile->getUser(),
            'crumbs' => $crumbs,
        ));
    }
}