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

namespace CCDNUser\ProfileBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 *
 * @category CCDNUser
 * @package  ProfileBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 1.0
 * @link     https://github.com/codeconsortium/CCDNUserProfileBundle
 *
 */
class CCDNUserProfileBundle extends Bundle
{
    /**
     *
     * @access public
     */
    public function boot()
    {
        $twig = $this->container->get('twig');
		
        $twig->addGlobal(
            'ccdn_user_profile',
            array(
                'seo' => array(
                    'title_length' => $this->container->getParameter('ccdn_user_profile.seo.title_length'),
                ),
				'member' => array(
					'list' => array(
						'layout_template' => $this->container->getParameter('ccdn_user_profile.member.list.layout_template'),
						'members_per_page' => $this->container->getParameter('ccdn_user_profile.member.list.members_per_page'),
						'member_since_datetime_format' => $this->container->getParameter('ccdn_user_profile.member.list.member_since_datetime_format'),
						'requires_login' => $this->container->getParameter('ccdn_user_profile.member.list.requires_login'),
					),
				),
                'profile' => array(
					'fallback_avatar' => $this->container->getParameter('ccdn_user_profile.profile.fallback_avatar'),
                    'show' => array(
                        'bio' => array(
                            'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.show.bio.layout_template'),
                        ),
                        'overview' => array(
                            'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.show.overview.layout_template'),
                            'last_login_datetime_format' => $this->container->getParameter('ccdn_user_profile.profile.show.overview.last_login_datetime_format'),
                            'member_since_datetime_format' => $this->container->getParameter('ccdn_user_profile.profile.show.overview.member_since_datetime_format'),
                        ),
                    ),
                    'edit' => array(
                        'personal' => array(
                            'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.personal.layout_template'),
                            'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.personal.form_theme'),
                        ),
                        'avatar' => array(
                            'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.avatar.layout_template'),
                            'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.avatar.form_theme'),
                        ),
                        'info' => array(
                            'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.info.layout_template'),
                            'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.info.form_theme'),
                        ),
                        'bio' => array(
                            'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.bio.layout_template'),
                            'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.bio.form_theme'),
                        ),
                        'contact' => array(
                            'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.contact.layout_template'),
                            'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.contact.form_theme'),
                        ),
                        'signature' => array(
                            'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.signature.layout_template'),
                            'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.signature.form_theme'),
                        ),
                    ),
                ),
                'sidebar' => array(
                    'links' => $this->container->getParameter('ccdn_user_profile.sidebar.links'),
                ),
            )
        ); // End Twig Globals.
    }
}
