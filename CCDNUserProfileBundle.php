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
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
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
		$twig->addGlobal('ccdn_user_profile', array(
			'seo' => array(
				'title_length' => $this->container->getParameter('ccdn_user_profile.seo.title_length'),
			),
			'item_bio' => array(
				'enable_bb_parser' => $this->container->getParameter('ccdn_user_profile.item_bio.enable_bb_parser'),
			),
			'item_signature' => array(
				'enable_bb_parser' => $this->container->getParameter('ccdn_user_profile.item_signature.enable_bb_parser'),
			),
			'profile' => array(
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
					'avatar' => array(
						'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.avatar.layout_template'),
						'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.avatar.form_theme'),
					),
					'bio' => array(
						'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.bio.layout_template'),
						'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.bio.form_theme'),
						'enable_bb_editor' => $this->container->getParameter('ccdn_user_profile.profile.edit.bio.enable_bb_editor'),
					),
					'contact' => array(
						'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.contact.layout_template'),
						'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.contact.form_theme'),
					),
					'personal' => array(
						'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.personal.layout_template'),
						'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.personal.form_theme'),
					),
					'signature' => array(
						'layout_template' => $this->container->getParameter('ccdn_user_profile.profile.edit.signature.layout_template'),
						'form_theme' => $this->container->getParameter('ccdn_user_profile.profile.edit.signature.form_theme'),
						'enable_bb_editor' => $this->container->getParameter('ccdn_user_profile.profile.edit.signature.enable_bb_editor'),
					),
				),
			),
			'sidebar' => array(
				'links' => $this->container->getParameter('ccdn_user_profile.sidebar.links'),
			),
		));
	}
	
}
