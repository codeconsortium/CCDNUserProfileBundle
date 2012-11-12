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

namespace CCDNUser\ProfileBundle\Component\MenuBuilder;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class Menu
{

    /**
     *      
	 * @access public
	 * @return array
     */
    public function buildMenu($builder)
    {
		$builder
			->arrayNode('layout')
				->arrayNode('header')
					->arrayNode('bottom')
						->buttonDropDownNode('accout_dropdown', array())
							->linkNode('ccdn_user_profile.layout.header.profile', 'ccdn_user_profile_show', array(
								'auth' => 'ROLE_USER',
								'label_trans_bundle' => 'CCDNUserProfileBundle',
								'rel' => 'nofollow',
							))->end()
							->dividerNode('sep1')->end()
						->end()
					->end()
				->end()
			->end();	
    }

}
