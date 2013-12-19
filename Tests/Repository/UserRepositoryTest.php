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

namespace CCDNUser\ProfileBundle\Tests\Repository;

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
class UserRepositoryTest extends TestBase
{
    public function testFindAllUsersWithProfilePaginated()
    {
		$this->addFixturesForUsers();
		$pager = $this->getUserModel()->findAllUsersWithProfilePaginated(1, 25);
		$items = $pager->getItems();
		$this->assertCount(4, $items);
    }

    public function testFindAllUsersWithProfileFilteredAToZPaginated()
    {
		$this->addFixturesForUsers();
		$pager = $this->getUserModel()->findAllUsersWithProfileFilteredAtoZPaginated('t', 1, 25);
		$items = $pager->getItems();
		$this->assertCount(1, $items);
    }

    public function testFindOneUserWithProfileByUsername()
	{
		$users = $this->addFixturesForUsers();
		$userFound = $this->getUserModel()->findOneUserWithProfileByUsername('tom');
		$this->assertNotNull($userFound);
		$this->assertSame($users['tom']->getId(), $userFound->getId());
	}

    public function testFindOneUserWithProfileById()
	{
		$users = $this->addFixturesForUsers();
		$userFound = $this->getUserModel()->findOneUserWithProfileById($users['tom']->getId());
		$this->assertNotNull($userFound);
		$this->assertSame($users['tom']->getId(), $userFound->getId());
	}
}