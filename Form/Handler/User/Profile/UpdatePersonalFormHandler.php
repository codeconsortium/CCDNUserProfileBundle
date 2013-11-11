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

namespace CCDNUser\ProfileBundle\Form\Handler\User\Profile;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;

use CCDNUser\ProfileBundle\Form\Handler\BaseFormHandler;
use CCDNUser\ProfileBundle\Model\Model\ModelInterface;
use CCDNUser\ProfileBundle\Entity\Profile;

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
class UpdatePersonalFormHandler extends BaseFormHandler
{
    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Form\Type\PersonalFormType $personalFormType
     */
    protected $personalFormType;

    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Model\Model\UserModel $userModel
     */
    protected $userModel;

    /**
     *
     * @access public
     * @param \Symfony\Component\Form\FormFactory                 $factory
     * @param \CCDNUser\ProfileBundle\Form\Type\PersonalFormType  $personalFormType
     * @param \CCDNUser\ProfileBundle\Model\Model\ModelInterface  $userModel
     */
    public function __construct(FormFactory $factory, $personalFormType, ModelInterface $userModel)
    {
        $this->factory = $factory;
        $this->personalFormType = $personalFormType;

        $this->userModel = $userModel;
    }

    /**
     *
     * @access public
     * @return Form
     */
    public function getForm()
    {
        if (null == $this->form) {
            $this->form = $this->factory->create($this->personalFormType, $this->user->getProfile());
        }

        return $this->form;
    }

    /**
     *
     * @access protected
     * @param  \CCDNUser\ProfileBundle\Entity\Profile         $profile
     * @return \CCDNUser\ProfileBundle\Manager\ProfileManager
     */
    protected function onSuccess(Profile $profile)
    {
        return $this->userModel->updateProfile($profile);
    }
}
