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
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 2.0
 */
class DashboardIntegrator
{
    /**
	 * 
	 * @access public
     * @param CCDNComponent\DashboardBundle\Component\Integrator\Model\BuilderInterface $builder
     */
    public function build(BuilderInterface $builder)
    {	
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
					->addLink('ccdn_user_profile_edit_personal')
						->setAuthRole('ROLE_USER')
						->setRoute('ccdn_user_profile_edit_personal')
						->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
						->setLabel('ccdn_user_profile.title.profile.edit_personal', array(), 'CCDNUserProfileBundle')
					->end()
					->addLink('ccdn_user_profile_contact')
						->setAuthRole('ROLE_USER')
						->setRoute('ccdn_user_profile_edit_contact')
						->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
						->setLabel('ccdn_user_profile.title.profile.edit_contact', array(), 'CCDNUserProfileBundle')
					->end()
					->addLink('ccdn_user_profile_edit_avatar')
						->setAuthRole('ROLE_USER')
						->setRoute('ccdn_user_profile_edit_avatar')
						->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
						->setLabel('ccdn_user_profile.title.profile.change_avatar', array(), 'CCDNUserProfileBundle')
					->end()
					->addLink('ccdn_user_profile_edit_bio')
						->setAuthRole('ROLE_USER')
						->setRoute('ccdn_user_profile_edit_bio')
						->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
						->setLabel('ccdn_user_profile.title.profile.edit_bio', array(), 'CCDNUserProfileBundle')
					->end()
					->addLink('ccdn_user_profile_edit_signature')
						->setAuthRole('ROLE_USER')
						->setRoute('ccdn_user_profile_edit_signature')
						->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_user.png')
						->setLabel('ccdn_user_profile.title.profile.edit_signature', array(), 'CCDNUserProfileBundle')
					->end()
				->end()
			->end()
		;
    }
}
