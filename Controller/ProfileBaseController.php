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

use CCDNUser\ProfileBundle\Entity\ProfileUserInterface;

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
class ProfileBaseController extends BaseController
{
    /**
     *
     * @access protected
     * @param  ProfileUserInterface            $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdatePersonalFormHandler
     */
    protected function getFormHandlerToEditPersonal(ProfileUserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.personal');

        $formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }

    /**
     *
     * @access protected
     * @param  ProfileUserInterface        $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateInfoFormHandler
     */
    protected function getFormHandlerToEditInfo(ProfileUserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.info');

        $formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }

    /**
     *
     * @access protected
     * @param  ProfileUserInterface           $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateContactFormHandler
     */
    protected function getFormHandlerToEditContact(ProfileUserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.contact');

        $formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }

    /**
     *
     * @access protected
     * @param  ProfileUserInterface          $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateAvatarFormHandler
     */
    protected function getFormHandlerToEditAvatar(ProfileUserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.avatar');

        $formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }

    /**
     *
     * @access protected
     * @param  ProfileUserInterface       $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateBioFormHandler
     */
    protected function getFormHandlerToEditBio(ProfileUserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.bio');

        $formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }

    /**
     *
     * @access protected
     * @param  ProfileUserInterface             $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateSignatureFormHandler
     */
    protected function getFormHandlerToEditSignature(ProfileUserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.signature');

        $formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }
}
