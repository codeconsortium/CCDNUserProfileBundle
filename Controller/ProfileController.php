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

use CCDNUser\ProfileBundle\Controller\ProfileBaseController;
use CCDNUser\ProfileBundle\Component\Dispatcher\ProfileEvents;
use CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileResponseEvent;

/**
 *
 * @category CCDNUser
 * @package  ProfileBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserProfileBundle
 *
 */
class ProfileController extends ProfileBaseController
{
    /**
     * Show a specific user's profile by user ID
     *
     * @access public
     * @param  int            $userId
     * @return RenderResponse
     */
    public function showOverviewAction($userId)
    {
        if ($this->container->getParameter('ccdn_user_profile.profile.show.requires_login') == true) {
            $this->isAuthorised('ROLE_USER');
        }

        if (null == $userId || $userId == 0) {
            $userId = $this->getUser()->getId();
        }

        $user = $this->getUserModel()->findOneUserWithProfileById($userId);

        return $this->renderResponse('CCDNUserProfileBundle:User:Profile/show_overview.html.', array(
            'crumbs' => $this->getCrumbs()->addProfileOverviewShow($user),
            'user' => $user,
            'profile' => $user->getProfile(),
        ));
    }

    /**
     * Show a specific user's profile by user ID
     *
     * @access public
     * @param  int            $userId
     * @return RenderResponse
     */
    public function showBioAction($userId)
    {
        if ($this->container->getParameter('ccdn_user_profile.profile.show.requires_login') == true) {
            $this->isAuthorised('ROLE_USER');
        }

        if (null == $userId || $userId == 0) {
            $userId = $this->getUser()->getId();
        }

        $user = $this->getUserModel()->findOneUserWithProfileById($userId);

        return $this->renderResponse('CCDNUserProfileBundle:User:Profile/show_bio.html.', array(
            'crumbs' => $this->getCrumbs()->addProfileBioShow($user),
            'user' => $user,
            'profile' => $user->getProfile(),
        ));
    }

    /**
     *
     * @access public
     * @param  int                             $userId
     * @return RedirectResponse|RenderResponse
     */
    public function editPersonalAction($userId)
    {
        $this->isAuthorised('ROLE_USER');

        if (null == $userId || $userId == 0) {
            $userId = $this->getUser()->getId();
        }

        $user = $this->getUserModel()->findOneUserWithProfileById($userId);

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($user->getId() != $this->getUser()->getId()) {
            $this->isAuthorised('ROLE_ADMIN');
        }

        $formHandler = $this->getFormHandlerToEditPersonal($user);

        if ($formHandler->process()) {
            $response = $this->redirectResponse($this->path('ccdn_user_profile_show_by_id', array('userId' => $user->getId())));
        } else {
            $response = $this->renderResponse('CCDNUserProfileBundle:User:Profile/edit_personal.html.', array(
                'crumbs' => $this->getCrumbs()->addProfilePersonalEdit($user),
                'user' => $user,
                'profile' => $user->getProfile(),
                'form' => $formHandler->getForm()->createView(),
            ));
        }

        $this->dispatch(ProfileEvents::USER_PROFILE_UPDATE_PERSONAL_RESPONSE, new UserProfileResponseEvent($this->getRequest(), $response, $formHandler->getForm()->getData()));

        return $response;
    }

    /**
     *
     * @access public
     * @param  int                             $userId
     * @return RedirectResponse|RenderResponse
     */
    public function editInfoAction($userId)
    {
        $this->isAuthorised('ROLE_USER');

        if (null == $userId || $userId == 0) {
            $userId = $this->getUser()->getId();
        }

        $user = $this->getUserModel()->findOneUserWithProfileById($userId);

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($user->getId() != $this->getUser()->getId()) {
            $this->isAuthorised('ROLE_ADMIN');
        }

        $formHandler = $this->getFormHandlerToEditInfo($user);

        if ($formHandler->process()) {
            $response = $this->redirectResponse($this->path('ccdn_user_profile_show_by_id', array('userId' => $user->getId())));
        } else {
            $response = $this->renderResponse('CCDNUserProfileBundle:User:Profile/edit_info.html.', array(
                'crumbs' => $this->getCrumbs()->addProfileInfoEdit($user),
                'user' => $user,
                'profile' => $user->getProfile(),
                'form' => $formHandler->getForm()->createView(),
            ));
        }

        $this->dispatch(ProfileEvents::USER_PROFILE_UPDATE_INFO_RESPONSE, new UserProfileResponseEvent($this->getRequest(), $response, $formHandler->getForm()->getData()));

        return $response;
    }

    /**
     *
     * @access public
     * @param  int                             $userId
     * @return RedirectResponse|RenderResponse
     */
    public function editContactAction($userId)
    {
        $this->isAuthorised('ROLE_USER');

        if (null == $userId || $userId == 0) {
            $userId = $this->getUser()->getId();
        }

        $user = $this->getUserModel()->findOneUserWithProfileById($userId);

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($user->getId() != $this->getUser()->getId()) {
            $this->isAuthorised('ROLE_ADMIN');
        }

        $formHandler = $this->getFormHandlerToEditContact($user);

        if ($formHandler->process()) {
            $response = $this->redirectResponse($this->path('ccdn_user_profile_show_by_id', array('userId' => $user->getId())));
        } else {
            $response = $this->renderResponse('CCDNUserProfileBundle:User:Profile/edit_contact.html.', array(
                'crumbs' => $this->getCrumbs()->addProfileContactEdit($user),
                'user' => $user,
                'profile' => $user->getProfile(),
                'form' => $formHandler->getForm()->createView(),
            ));
        }

        $this->dispatch(ProfileEvents::USER_PROFILE_UPDATE_CONTACT_RESPONSE, new UserProfileResponseEvent($this->getRequest(), $response, $formHandler->getForm()->getData()));

        return $response;
    }

    /**
     *
     * @access public
     * @param  int                             $userId
     * @return RedirectResponse|RenderResponse
     */
    public function editAvatarAction($userId)
    {
        $this->isAuthorised('ROLE_USER');

        if (null == $userId || $userId == 0) {
            $userId = $this->getUser()->getId();
        }

        $user = $this->getUserModel()->findOneUserWithProfileById($userId);

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($user->getId() != $this->getUser()->getId()) {
            $this->isAuthorised('ROLE_ADMIN');
        }

        $formHandler = $this->getFormHandlerToEditAvatar($user);

        if ($formHandler->process()) {
            $response = $this->redirectResponse($this->path('ccdn_user_profile_show_by_id', array('userId' => $user->getId())));
        } else {
            $response = $this->renderResponse('CCDNUserProfileBundle:User:Profile/edit_avatar.html.', array(
                'crumbs' => $this->getCrumbs()->addProfileAvatarEdit($user),
                'user' => $user,
                'profile' => $user->getProfile(),
                'form' => $formHandler->getForm()->createView(),
            ));
        }

        $this->dispatch(ProfileEvents::USER_PROFILE_UPDATE_AVATAR_RESPONSE, new UserProfileResponseEvent($this->getRequest(), $response, $formHandler->getForm()->getData()));

        return $response;
    }

    /**
     *
     * @access public
     * @param  int                             $userId
     * @return RedirectResponse|RenderResponse
     */
    public function editBioAction($userId)
    {
        $this->isAuthorised('ROLE_USER');

        if (null == $userId || $userId == 0) {
            $userId = $this->getUser()->getId();
        }

        $user = $this->getUserModel()->findOneUserWithProfileById($userId);

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($user->getId() != $this->getUser()->getId()) {
            $this->isAuthorised('ROLE_ADMIN');
        }

        $formHandler = $this->getFormHandlerToEditBio($user);

        if ($formHandler->process()) {
            $response = $this->redirectResponse($this->path('ccdn_user_profile_show_bio_by_id', array('userId' => $user->getId())));
        } else {
            $response = $this->renderResponse('CCDNUserProfileBundle:User:Profile/edit_bio.html.', array(
                'crumbs' => $this->getCrumbs()->addProfileBioEdit($user),
                'user' => $user,
                'profile' => $user->getProfile(),
                'form' => $formHandler->getForm()->createView(),
            ));
        }

        $this->dispatch(ProfileEvents::USER_PROFILE_UPDATE_BIO_RESPONSE, new UserProfileResponseEvent($this->getRequest(), $response, $formHandler->getForm()->getData()));

        return $response;
    }

    /**
     *
     * @access public
     * @param  int                             $userId
     * @return RedirectResponse|RenderResponse
     */
    public function editSignatureAction($userId)
    {
        $this->isAuthorised('ROLE_USER');

        if (null == $userId || $userId == 0) {
            $userId = $this->getUser()->getId();
        }

        $user = $this->getUserModel()->findOneUserWithProfileById($userId);

        // Does the requested $user match our session user id? Or, are we an admin?
        if ($user->getId() != $this->getUser()->getId()) {
            $this->isAuthorised('ROLE_ADMIN');
        }

        $formHandler = $this->getFormHandlerToEditSignature($user);

        if ($formHandler->process()) {
            $response = $this->redirectResponse($this->path('ccdn_user_profile_show_bio_by_id', array('userId' => $user->getId())));
        } else {
            $response = $this->renderResponse('CCDNUserProfileBundle:User:Profile/edit_signature.html.', array(
                'crumbs' => $this->getCrumbs()->addProfileSignatureEdit($user),
                'user' => $user,
                'profile' => $user->getProfile(),
                'form' => $formHandler->getForm()->createView(),
            ));
        }

        $this->dispatch(ProfileEvents::USER_PROFILE_UPDATE_SIGNATURE_RESPONSE, new UserProfileResponseEvent($this->getRequest(), $response, $formHandler->getForm()->getData()));

        return $response;
    }
}
