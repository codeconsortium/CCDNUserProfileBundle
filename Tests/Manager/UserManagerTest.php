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
class UserManagerTest extends TestBase
{
	public function testCheckUserHasProfile()
	{
		$users = $this->addFixturesForUsers();
		$this->getUserModel()->checkUserHasProfile($users['tom']);
		$userFound = $this->getUserModel()->findOneUserWithProfileById($users['tom']->getId());
		$this->assertNotNull($userFound);
		$this->assertSame($users['tom']->getId(), $userFound->getId());
		$this->assertNotNull($userFound->getProfile());
	}
}