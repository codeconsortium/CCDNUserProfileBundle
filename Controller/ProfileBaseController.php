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
use CCDNUser\ProfileBundle\Entity\Profile;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class ProfileBaseController extends BaseController
{
    /**
     *
     * @access public
     * @param \CCDNUser\ProfileBundle\Entity\Profile $profile
	 * @return \CCDNUser\ProfileBundle\Form\Handler\UpdatePersonalFormHandler
     */
    public function getFormHandlerToEditPersonal(Profile $profile)
    {		
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.personal');

        $formHandler->setProfile($profile);
		
		return $formHandler;
    }

    /**
     *
     * @access public
     * @param \CCDNUser\ProfileBundle\Entity\Profile $profile
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdateContactFormHandler
     */
    public function getFormHandlerToEditContact(Profile $profile)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.contact');

        $formHandler->setProfile($profile);
		
		return $formHandler;
    }

    /**
     *
     * @access public
     * @param \CCDNUser\ProfileBundle\Entity\Profile $profile
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdateAvatarFormHandler
     */
    public function getFormHandlerToEditAvatar(Profile $profile)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.avatar');

        $formHandler->setProfile($profile);
		
		return $formHandler;
    }

    /**
     *
     * @access public
     * @param \CCDNUser\ProfileBundle\Entity\Profile $profile
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdateBioFormHandler
     */
    public function getFormHandlerToEditBio(Profile $profile)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.bio');

        $formHandler->setProfile($profile);
		
		return $formHandler;
    }

    /**
     *
     * @access public
     * @param \CCDNUser\ProfileBundle\Entity\Profile $profile
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdateSignatureFormHandler
     */
    public function getFormHandlerToEditSignature(Profile $profile)
    {
        $formHandler = $this->container->get('ccdn_user_profile.form.handler.signature');

        $formHandler->setProfile($profile);
		
		return $formHandler;
    }
}