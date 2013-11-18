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

namespace CCDNUser\ProfileBundle\Tests\Manager;

use CCDNUser\ProfileBundle\Tests\TestBase;

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
class ProfileManagerTest extends TestBase
{
	public function testUpdateProfile()
	{
		$users = $this->addFixturesForUsers();
		$userFound = $this->getUserModel()->findOneUserWithProfileById($users['tom']->getId());
		$profile = $userFound->getProfile();
		$profile->setBio('Foobar');
		$this->getProfileModel()->updateProfile($profile);
		$this->assertNotNull($userFound);
		$this->assertSame($users['tom']->getId(), $userFound->getId());
		$this->assertSame($users['tom']->getProfile()->getBio(), 'Foobar');
	}
}