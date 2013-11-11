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

namespace CCDNUser\ProfileBundle\Component\Dashboard;

use CCDNComponent\DashboardBundle\Component\Integrator\Model\BuilderInterface;

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
class DashboardIntegrator
{
    /**
     *
     * @access protected
     * @var bool $requiresLogin
     */
    protected $requiresLogin;

    /**
     *
     * @access public
     * @param bool $requiresLogin
     */
    public function __construct($requiresLogin)
    {
        $this->requiresLogin = $requiresLogin;
    }

    /**
     *
     * @access public
     * @param CCDNComponent\DashboardBundle\Component\Integrator\Model\BuilderInterface $builder
     */
    public function build(BuilderInterface $builder)
    {
        $builder
            ->addCategory('community')
                ->setLabel('ccdn_user_profile.dashboard.categories.user', array(), 'CCDNUserProfileBundle')
                ->addLinks()
                    ->addLink('members')
                        ->setAuthRole(($this->requiresLogin ? 'ROLE_USER': null))
                        ->setRoute('ccdn_user_profile_index')
                        ->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_users.png')
                        ->setLabel('ccdn_user_profile.title.members', array(), 'CCDNUserProfileBundle')
                    ->end()
                ->end()
            ->end()
        ;
		
        $builder
            ->addCategory('profile')
                ->setLabel('ccdn_user_profile.dashboard.categories.profile', array(), 'CCDNUserProfileBundle')
                ->addPages()
                    ->addPage('profile')
                        ->setLabel('ccdn_user_profile.dashboard.pages.profile', array(), 'CCDNUserProfileBundle')
                    ->end()
                    ->addPage('account')
                        ->setLabel('ccdn_user_profile.dashboard.pages.account', array(), 'CCDNUserProfileBundle')
                    ->end()
                ->end()
                ->addLinks()
                    ->addLink('show_profile')
                        ->setAuthRole('ROLE_USER')
                        ->setRoute('ccdn_user_profile_show')
                        ->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
                        ->setLabel('ccdn_user_profile.dashboard.links.show_profile', array(), 'CCDNUserProfileBundle')
                    ->end()
                    ->addLink('ccdn_user_profile_personal_edit')
                        ->setAuthRole('ROLE_USER')
                        ->setRoute('ccdn_user_profile_personal_edit')
                        ->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
                        ->setLabel('ccdn_user_profile.title.profile.edit_personal', array(), 'CCDNUserProfileBundle')
                    ->end()
                    ->addLink('ccdn_user_profile_contact')
                        ->setAuthRole('ROLE_USER')
                        ->setRoute('ccdn_user_profile_contact_edit')
                        ->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
                        ->setLabel('ccdn_user_profile.title.profile.edit_contact', array(), 'CCDNUserProfileBundle')
                    ->end()
                    ->addLink('ccdn_user_profile_avatar_edit')
                        ->setAuthRole('ROLE_USER')
                        ->setRoute('ccdn_user_profile_avatar_edit')
                        ->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
                        ->setLabel('ccdn_user_profile.title.profile.change_avatar', array(), 'CCDNUserProfileBundle')
                    ->end()
                    ->addLink('ccdn_user_profile_bio_edit')
                        ->setAuthRole('ROLE_USER')
                        ->setRoute('ccdn_user_profile_bio_edit')
                        ->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
                        ->setLabel('ccdn_user_profile.title.profile.edit_bio', array(), 'CCDNUserProfileBundle')
                    ->end()
                    ->addLink('ccdn_user_profile_signature_edit')
                        ->setAuthRole('ROLE_USER')
                        ->setRoute('ccdn_user_profile_signature_edit')
                        ->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
                        ->setLabel('ccdn_user_profile.title.profile.edit_signature', array(), 'CCDNUserProfileBundle')
                    ->end()
                ->end()
            ->end()
        ;
    }
}
