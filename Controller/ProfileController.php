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
     * @param  int                             $user_id
     * @return RedirectResponse|RenderResponse
     */
    public function showOverviewAction($user_id)
    {
        if ($this->container->getParameter('ccdn_user_profile.profile.show.requires_login') == 'true') {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new AccessDeniedException('You do not have access to this section.');
            }
        }

        if (! $user_id || $user_id == 0) {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new NotFoundHttpException('User not found!');
            }

            $user = $this->container->get('security.context')->getToken()->getUser();
        } else {
            $user = $this->container->get('ccdn_user_profile.profile.repository')->findOneByIdJoinedToUser($user_id);
        }

        if ( ! is_object($user) || ! ($user instanceof UserInterface)) {
            throw new NotFoundHttpException('User not found!');
        }

        $crumb_trail = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('crumbs.members', array(), 'CCDNUserMemberBundle'), $this->container->get('router')->generate('cc_members_index', array()), "users")
            ->add($this->container->get('translator')->trans('crumbs.profile', array('%user_name%' => ucfirst($user->getUsername())), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())), "user");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:show_overview.html.' . $this->getEngine(), array(
            'user' => $user,
            'crumbs' => $crumb_trail,
        ));
    }

    /**
     * /profile/my/profile
     * /user/{user_id}/profile
     * Show a specific user by ID
      *
     *
     * @access public
     * @param  int                             $user_id
     * @return RedirectResponse|RenderResponse
     */
    public function showBioAction($user_id)
    {
        if ($this->container->getParameter('ccdn_user_profile.profile.show.requires_login') == 'true') {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new AccessDeniedException('You do not have access to this section.');
            }
        }

        if (! $user_id || $user_id == 0) {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new NotFoundHttpException('User not found!');
            }

            $user = $this->container->get('security.context')->getToken()->getUser();
        } else {
            $user = $this->container->get('ccdn_user_profile.profile.repository')->findOneByIdJoinedToUser($user_id);
        }

        if ( ! is_object($user) || ! ($user instanceof UserInterface)) {
            throw new NotFoundHttpException('User not found!');
        }

        $crumb_trail = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('crumbs.members', array(), 'CCDNUserMemberBundle'), $this->container->get('router')->generate('cc_members_index', array()), "users")
            ->add($this->container->get('translator')->trans('crumbs.profile', array('%user_name%' => ucfirst($user->getUsername())), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())), "user");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:show_bio.html.' . $this->getEngine(), array(
            'user' => $user,
            'crumbs' => $crumb_trail,
        ));
    }

    /**
     * /profile/edit
     *
     *
     * @access public
     * @param  int                             $user_id
     * @return RedirectResponse|RenderResponse
     */
    public function editPersonalAction($user_id)
    {
        //
        // Do we have an ID, and are we logged in?
        //
        if (! $user_id || $user_id == 0) {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new NotFoundHttpException('User not found!');
            }

            $user = $this->container->get('security.context')->getToken()->getUser();
        } else {
            $user = $this->container->get('ccdn_user_profile.profile.repository')->findOneByIdJoinedToUser($user_id);
        }

        //
        // Have we retrieved a valid user object?
        //
        if ( ! is_object($user) || ! ($user instanceof UserInterface)) {
            throw new NotFoundHttpException('User not found!');
        }

        //
        // Does the requested $user match our session user id? Or, are we an admin?
        //
        if ($user->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
        && ! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('You do not have access to this section.');
        }

        //
        // get the user associated profile
        //
        $profile = $user->getProfile();

        //
        // if the profile has no id then it does not exist, so create one.
        //
        if ( ! $profile->getId()) {
            $this->container->get('ccdn_user_profile.profile.manager')->insert($profile)->flush();
        }

        $formHandler = $this->container->get('ccdn_user_profile.profile.personal.form.handler');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())));
        }

        $crumb_trail = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('crumbs.members', array(), 'CCDNUserMemberBundle'), $this->container->get('router')->generate('cc_members_index', array()), "users")
            ->add($this->container->get('translator')->trans('crumbs.profile', array('%user_name%' => ucfirst($user->getUsername())), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())), "user")
            ->add($this->container->get('translator')->trans('crumbs.profile.edit.personal', array(), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_edit_personal', array('user_id' => $user->getId())), "edit");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:edit_personal.html.' . $this->getEngine(), array(
            'form' => $formHandler->getForm()->createView(),
            'user' => $user,
            'crumbs' => $crumb_trail,
        ));
    }

    /**
     * /profile/edit
     *
     *
     * @access public
     * @param  int                             $user_id
     * @return RedirectResponse|RenderResponse
     */
    public function editContactAction($user_id)
    {
        //
        // Do we have an ID, and are we logged in?
        //
        if (! $user_id || $user_id == 0) {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new NotFoundHttpException('User not found!');
            }

            $user = $this->container->get('security.context')->getToken()->getUser();
        } else {
            $user = $this->container->get('ccdn_user_profile.profile.repository')->findOneByIdJoinedToUser($user_id);
        }

        //
        // Have we retrieved a valid user object?
        //
        if ( ! is_object($user) || ! ($user instanceof UserInterface)) {
            throw new NotFoundHttpException('User not found!');
        }

        //
        // Does the requested $user match our session user id? Or, are we an admin?
        //
        if ($user->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
        && ! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('You do not have access to this section.');
        }

        //
        // get the user associated profile
        //
        $profile = $user->getProfile();

        //
        // if the profile has no id then it does not exist, so create one.
        //
        if ( ! $profile->getId()) {
            $this->container->get('ccdn_user_profile.profile.manager')->insert($profile)->flush();
        }

        $formHandler = $this->container->get('ccdn_user_profile.profile.contact.form.handler');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())));
        }

        $crumb_trail = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('crumbs.members', array(), 'CCDNUserMemberBundle'), $this->container->get('router')->generate('cc_members_index', array()), "users")
            ->add($this->container->get('translator')->trans('crumbs.profile', array('%user_name%' => ucfirst($user->getUsername())), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())), "user")
            ->add($this->container->get('translator')->trans('crumbs.profile.edit.contact', array(), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_edit_contact', array('user_id' => $user->getId())), "edit");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:edit_contact.html.' . $this->getEngine(), array(
            'form' => $formHandler->getForm()->createView(),
            'user' => $user,
            'crumbs' => $crumb_trail,
        ));
    }

    /**
     * /profile/edit
     *
     *
     * @access public
     * @param  int                             $user_id
     * @return RedirectResponse|RenderResponse
     */
    public function editAvatarAction($user_id)
    {
        //
        // Do we have an ID, and are we logged in?
        //
        if (! $user_id || $user_id == 0) {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new NotFoundHttpException('User not found!');
            }

            $user = $this->container->get('security.context')->getToken()->getUser();
        } else {
            $user = $this->container->get('ccdn_user_profile.profile.repository')->findOneByIdJoinedToUser($user_id);
        }

        //
        // Have we retrieved a valid user object?
        //
        if ( ! is_object($user) || ! ($user instanceof UserInterface)) {
            throw new NotFoundHttpException('User not found!');
        }

        //
        // Does the requested $user match our session user id? Or, are we an admin?
        //
        if ($user->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
        && ! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('You do not have access to this section.');
        }

        //
        // get the user associated profile
        //
        $profile = $user->getProfile();

        //
        // if the profile has no id then it does not exist, so create one.
        //
        if ( ! $profile->getId()) {
            $this->container->get('ccdn_user_profile.profile.manager')->insert($profile)->flush();
        }

        $formHandler = $this->container->get('ccdn_user_profile.profile.avatar.form.handler');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())));
        }

        $crumb_trail = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('crumbs.members', array(), 'CCDNUserMemberBundle'), $this->container->get('router')->generate('cc_members_index', array()), "users")
            ->add($this->container->get('translator')->trans('crumbs.profile', array('%user_name%' => ucfirst($user->getUsername())), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())), "user")
            ->add($this->container->get('translator')->trans('crumbs.profile.edit.avatar', array(), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_edit_avatar', array('user_id' => $user->getId())), "edit");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:edit_avatar.html.' . $this->getEngine(), array(
            'form' => $formHandler->getForm()->createView(),
            'user' => $user,
            'crumbs' => $crumb_trail,
        ));
    }

    /**
     * /profile/edit
     *
     *
     * @access public
     * @param  int                             $user_id
     * @return RedirectResponse|RenderResponse
     */
    public function editBioAction($user_id)
    {
        //
        // Do we have an ID, and are we logged in?
        //
        if (! $user_id || $user_id == 0) {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new NotFoundHttpException('User not found!');
            }

            $user = $this->container->get('security.context')->getToken()->getUser();
        } else {
            $user = $this->container->get('ccdn_user_profile.profile.repository')->findOneByIdJoinedToUser($user_id);
        }

        //
        // Have we retrieved a valid user object?
        //
        if ( ! is_object($user) || ! ($user instanceof UserInterface)) {
            throw new NotFoundHttpException('User not found!');
        }

        //
        // Does the requested $user match our session user id? Or, are we an admin?
        //
        if ($user->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
        && ! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('You do not have access to this section.');
        }

        //
        // get the user associated profile
        //
        $profile = $user->getProfile();

        //
        // if the profile has no id then it does not exist, so create one.
        //
        if ( ! $profile->getId()) {
            $this->container->get('ccdn_user_profile.profile.manager')->insert($profile)->flush();
        }

        $formHandler = $this->container->get('ccdn_user_profile.profile.bio.form.handler');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('cc_profile_show_bio_by_id', array('user_id' => $user->getId())));
        }

        $crumb_trail = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('crumbs.members', array(), 'CCDNUserMemberBundle'), $this->container->get('router')->generate('cc_members_index', array()), "users")
            ->add($this->container->get('translator')->trans('crumbs.profile', array('%user_name%' => ucfirst($user->getUsername())), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())), "user")
            ->add($this->container->get('translator')->trans('crumbs.profile.edit.bio', array(), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_edit_bio', array('user_id' => $user->getId())), "edit");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:edit_bio.html.' . $this->getEngine(), array(
            'form' => $formHandler->getForm()->createView(),
            'user' => $user,
            'crumbs' => $crumb_trail,
        ));
    }

    /**
     * /profile/edit
     *
     *
     * @access public
     * @param  int                             $user_id
     * @return RedirectResponse|RenderResponse
     */
    public function editSignatureAction($user_id)
    {
        //
        // Do we have an ID, and are we logged in?
        //
        if (! $user_id || $user_id == 0) {
            if ( ! $this->container->get('security.context')->isGranted('ROLE_USER')) {
                throw new NotFoundHttpException('User not found!');
            }

            $user = $this->container->get('security.context')->getToken()->getUser();
        } else {
            $user = $this->container->get('ccdn_user_profile.profile.repository')->findOneByIdJoinedToUser($user_id);
        }

        //
        // Have we retrieved a valid user object?
        //
        if ( ! is_object($user) || ! ($user instanceof UserInterface)) {
            throw new NotFoundHttpException('User not found!');
        }

        //
        // Does the requested $user match our session user id? Or, are we an admin?
        //
        if ($user->getId() != $this->container->get('security.context')->getToken()->getUser()->getId()
        && ! $this->container->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('You do not have access to this section.');
        }

        //
        // get the user associated profile
        //
        $profile = $user->getProfile();

        //
        // if the profile has no id then it does not exist, so create one.
        //
        if ( ! $profile->getId()) {
            $this->container->get('ccdn_user_profile.profile.manager')->insert($profile)->flush();
        }

        $formHandler = $this->container->get('ccdn_user_profile.profile.signature.form.handler');

        $process = $formHandler->process($profile);

        if ($process) {
            $this->container->get('session')->setFlash('notice', $this->container->get('translator')->trans('flash.profile.edit.success', array(), 'CCDNUserProfileBundle'));

            return new RedirectResponse($this->container->get('router')->generate('cc_profile_show_bio_by_id', array('user_id' => $user->getId())));
        }

        $crumb_trail = $this->container->get('ccdn_component_crumb.trail')
            ->add($this->container->get('translator')->trans('crumbs.members', array(), 'CCDNUserMemberBundle'), $this->container->get('router')->generate('cc_members_index', array()), "users")
            ->add($this->container->get('translator')->trans('crumbs.profile', array('%user_name%' => ucfirst($user->getUsername())), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_show_by_id', array('user_id' => $user->getId())), "user")
            ->add($this->container->get('translator')->trans('crumbs.profile.edit.signature', array(), 'CCDNUserProfileBundle'), $this->container->get('router')->generate('cc_profile_edit_signature', array('user_id' => $user->getId())), "edit");

        return $this->container->get('templating')->renderResponse('CCDNUserProfileBundle:Profile:edit_signature.html.' . $this->getEngine(), array(
            'form' => $formHandler->getForm()->createView(),
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
