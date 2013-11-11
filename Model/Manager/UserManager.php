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

namespace CCDNUser\ProfileBundle\Model\Manager;

use Symfony\Component\Security\Core\User\UserInterface;

use CCDNUser\ProfileBundle\Model\Manager\ManagerInterface;
use CCDNUser\ProfileBundle\Model\Manager\BaseManager;

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
class UserManager extends BaseManager implements ManagerInterface
{
	/**
	 * 
	 * @access public
	 * @param  \Symfony\Component\Security\Core\User\UserInterface $user
	 */
	public function checkUserHasProfile(UserInterface $user)
	{
		if (null == $user->getProfile()) {
			$profile = new Profile();
			$profile->setUser($user);
			$user->setProfile($profile);

			$this->persist($profile);
			$this->flush();
			$this->refresh($user);
		}
		
		return $this;
	}

	/**
	 * 
	 * @access public
	 * @param  \CCDNUser\ProfileBundle\Entity\Profile $profile
	 */
	public function updateProfile(Profile $profile)
	{
		$this->persist($profile);
		$this->flush();
		
		return $this;
	}
}
