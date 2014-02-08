<?php

namespace CCDNUser\ProfileBundle\Tests\EventListener;

use CCDNUser\ProfileBundle\Tests\TestBase;

/**
 * Functional test for the ProfileUserCreationListener.
 *
 * The listener is expected to create a default profile for new user entities.
 *
 * @todo license
 */
class ProfileUserCreationListenerTest extends TestBase
{
    /**
     * @group new
     */
    public function testNewUsersHaveProfile()
    {
        $this->addNewUser('foobar', 'foobar@example.com', 'password');
        $this->flushDatabaseChanges();
        $user = $this->getUserModel()->findOneUserWithProfileByUsername('foobar');
        $this->assertInstanceOf('\CCDNUser\ProfileBundle\Entity\Profile', $user->getProfile());
    }
}
 