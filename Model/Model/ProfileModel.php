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

namespace CCDNUser\ProfileBundle\Model\Model;

use CCDNUser\ProfileBundle\Model\Model\BaseModel;
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
class ProfileModel extends BaseModel implements ModelInterface
{
	/**
	 * 
	 * @access public
	 * @param  \CCDNUser\ProfileBundle\Entity\Profile $profile
	 */
	public function updateProfile(Profile $profile)
	{
		return $this->getManager()->updateProfile($profile);
	}
}
