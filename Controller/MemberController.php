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
class MemberController extends BaseController
{
    /**
     *
     * @access public
     * @return RenderResponse
     */
    public function showAction()
    {
        if ($this->container->getParameter('ccdn_user_profile.member.list.requires_login') == 'true') {
            $this->isAuthorised('ROLE_USER');
        }

		$page = $this->getQuery('page', 1);
		$alpha = $this->getQuery('alpha', null);
		
		if ($alpha) {
			$membersPager = $this->getUserModel()->findAllUsersWithProfileFilteredAtoZPaginated($page, $alpha);
		} else {
	        $membersPager = $this->getUserModel()->findAllUsersWithProfilePaginated($page);
		}
		//ldd($membersPager->getItems());
        return $this->renderResponse('CCDNUserProfileBundle:User:Member/list.html.', array(
            'pager' => $membersPager,
			'alpha' => $alpha,
        ));
    }
}
