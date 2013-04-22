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

namespace CCDNUser\ProfileBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;

use CCDNUser\ProfileBundle\Manager\BaseManagerInterface;
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
class UpdatePersonalFormHandler
{
    /**
     *
     * @access protected
     * @var \Symfony\Component\Form\FormFactory $factory
     */
    protected $factory;

    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Form\Type\PersonalFormType $personalFormType
     */
    protected $personalFormType;

    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Form\Type\PersonalFornType $form
     */
    protected $form;

    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Manager\BaseManagerInterface $manager
     */
    protected $manager;

    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Entity\Profile $profile
     */
    protected $profile;

    /**
     *
     * @access public
     * @param \Symfony\Component\Form\FormFactory                  $factory
     * @param \CCDNUser\ProfileBundle\Form\Type\PersonalFormType   $personalFormType
     * @param \CCDNUser\ProfileBundle\Manager\BaseManagerInterface $manager
     */
    public function __construct(FormFactory $factory, $personalFormType, BaseManagerInterface $manager)
    {
        $this->factory = $factory;
        $this->personalFormType = $personalFormType;

        $this->manager = $manager;
    }

    /**
     *
     * @access public
     * @param  \CCDNUser\ProfileBundle\Entity\Profile                         $profile
     * @return \CCDNUser\ProfileBundle\Form\Handler\UpdatePersonalFormHandler
     */
    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\HttpFoundation\Request $request
     * @return string
     */
    public function getSubmitAction(Request $request)
    {
        if ($request->request->has('submit')) {
            $action = key($request->request->get('submit'));
        } else {
            $action = 'post';
        }

        return $action;
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\HttpFoundation\Request $request
     * @return bool
     */
    public function process(Request $request)
    {
        $this->getForm();

        if ($request->getMethod() == 'POST') {
            $this->form->bindRequest($request);

            if ($this->form->isValid()) {
                $user = $this->form->getData();

                if ($this->getSubmitAction($request) == 'save') {
                    $this->onSuccess($user);

                    return true;
                }
            }
        }

        return false;
    }

    /**
     *
     * @access public
     * @return Form
     */
    public function getForm()
    {
        if (null == $this->form) {
            $this->form = $this->factory->create($this->personalFormType, $this->profile);
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
        return $this->manager->updateProfile($profile)->flush();
    }
}
