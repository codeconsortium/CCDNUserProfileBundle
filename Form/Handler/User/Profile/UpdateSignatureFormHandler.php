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
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;

use CCDNUser\ProfileBundle\Component\Dispatcher\ProfileEvents;
use CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent;
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
class UpdateSignatureFormHandler extends BaseFormHandler
{
    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Form\Type\SignatureFormType $signatureFormType
     */
    protected $signatureFormType;

    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Model\Model\ProfileModel $profileModel
     */
    protected $profileModel;

    /**
     *
     * @access public
     * @param \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher $dispatcher
     * @param \Symfony\Component\Form\FormFactory                              $factory
     * @param \CCDNUser\ProfileBundle\Form\Type\SignatureFormType              $signatureFormType
     * @param \CCDNUser\ProfileBundle\Model\Model\ModelInterface               $profileModel
     */
    public function __construct(ContainerAwareEventDispatcher $dispatcher, FormFactory $factory, $signatureFormType, ModelInterface $profileModel)
    {
		$this->dispatcher = $dispatcher;
        $this->factory = $factory;
        $this->signatureFormType = $signatureFormType;

        $this->profileModel = $profileModel;
    }

    /**
     *
     * @access public
     * @return Form
     */
    public function getForm()
    {
        if (null == $this->form) {
            $this->dispatcher->dispatch(ProfileEvents::USER_PROFILE_UPDATE_SIGNATURE_INITIALISE, new UserProfileEvent($this->request, $this->user->getProfile()));
			
            $this->form = $this->factory->create($this->signatureFormType, $this->user->getProfile());
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
        $this->dispatcher->dispatch(ProfileEvents::USER_PROFILE_UPDATE_SIGNATURE_SUCCESS, new UserProfileEvent($this->request, $profile));
		
        $this->profileModel->updateProfile($profile);
		
        $this->dispatcher->dispatch(ProfileEvents::USER_PROFILE_UPDATE_SIGNATURE_COMPLETE, new UserProfileEvent($this->request, $profile));
    }
}
