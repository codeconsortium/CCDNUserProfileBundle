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

namespace CCDNUser\ProfileBundle\Tests\EventListener;

use CCDNUser\ProfileBundle\Tests\TestBase;

/**
 * Functional test for the ProfileUserCreationListener.
 *
 * The listener is expected to create a default profile for new user entities.
 *
 * @category CCDNUser
 * @package  ProfileBundle
 *
 * @author   Maarten Jacobs <maarten.j.jacobs@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserProfileBundle
 *
 */
class ProfileUserCreationListenerTest extends TestBase
{
    public function testNewUsersHaveProfile()
    {
        $this->addNewUser('foobar', 'foobar@example.com', 'password');
        $this->flushDatabaseChanges();
        $user = $this->getUserModel()->findOneUserWithProfileByUsername('foobar');
        $this->assertInstanceOf('\CCDNUser\ProfileBundle\Entity\Profile', $user->getProfile());
        $this->assertEquals($user, $user->getProfile()->getUser());
    }
}
 