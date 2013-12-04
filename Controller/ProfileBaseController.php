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

use Symfony\Component\Security\Core\User\UserInterface;
use CCDNUser\ProfileBundle\Controller\BaseController;

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
     * @param  \Symfony\Component\Security\Core\User\UserInterface            $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdatePersonalFormHandler
     */
    protected function getFormHandlerToEditPersonal(UserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.personal');

		$formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }

    /**
     *
     * @access protected
     * @param  \Symfony\Component\Security\Core\User\UserInterface        $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdateInfoFormHandler
     */
    protected function getFormHandlerToEditInfo(UserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.info');

		$formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }

    /**
     *
     * @access protected
     * @param  \Symfony\Component\Security\Core\User\UserInterface           $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdateContactFormHandler
     */
    protected function getFormHandlerToEditContact(UserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.contact');

		$formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }

    /**
     *
     * @access protected
     * @param  \Symfony\Component\Security\Core\User\UserInterface          $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdateAvatarFormHandler
     */
    protected function getFormHandlerToEditAvatar(UserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.avatar');

		$formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }

    /**
     *
     * @access protected
     * @param  \Symfony\Component\Security\Core\User\UserInterface       $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdateBioFormHandler
     */
    protected function getFormHandlerToEditBio(UserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.bio');

		$formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }

    /**
     *
     * @access protected
     * @param  \Symfony\Component\Security\Core\User\UserInterface             $user
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdateSignatureFormHandler
     */
    protected function getFormHandlerToEditSignature(UserInterface $user)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.signature');

		$formHandler->setRequest($this->getRequest());
        $formHandler->setUser($user);

        return $formHandler;
    }
}
