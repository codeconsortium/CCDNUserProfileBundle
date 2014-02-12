<?php

namespace CCDNUser\ProfileBundle\Tests\Command;

use CCDNUser\ProfileBundle\Tests\TestBase;
use CCDNUser\ProfileBundle\Command\MigrateUsersCommand;
use Doctrine\ORM\Events;

class MigrateUsersCommandTest extends TestBase
{
    /**
     * @var MigrateUsersCommand
     */
    private $command;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $input;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $output;

    public function setUp()
    {
        parent::setUp();

        $this->command = $this->container->get('ccdn_user_profile.command.migrate_user');

        $this->input = $this->getMockBuilder('Symfony\Component\Console\Input\InputInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $this->output = $this->getMockBuilder('Symfony\Component\Console\Output\OutputInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testAttachingDefaultProfilesToUsersWithoutProfiles()
    {
        $faultyUserIds = $this->insertUsersWithoutProfiles();
        $this->command->execute($this->input, $this->output);
        $this->assertUsersHaveProfiles($faultyUserIds);
    }

    /**
     * Inserts two users without profiles into database forcefully, to simulate a pre-existing user, or an incorrectly
     * created user after bundle installation.
     */
    private function insertUsersWithoutProfiles()
    {
        $faultyUserIds = array();
        $eventListener = $this->container->get('ccdn_user_profile.listener.user_creation');

        // Remove the event listener, as though the bundle was not installed.
        $evm = $this->em->getEventManager();
        $evm->removeEventListener(Events::prePersist, $eventListener);

        $faultyUser = $this->addNewUser('phil', 'phil@example.com', 'password');
        $this->flushDatabaseChanges();
        $faultyUserIds[] = $faultyUser->getId();

        $faultyUser = $this->addNewUser('charles', 'charles@example.com', 'password');
        $this->flushDatabaseChanges();
        $faultyUserIds[] = $faultyUser->getId();

        // Re-attach the event listener.
        $evm->addEventListener(Events::prePersist, $eventListener);

        return $faultyUserIds;
    }

    private function assertUsersHaveProfiles(array $userIds)
    {
        // Clear the doctrine cache: this makes sure we're checking against the permanently stored state of users.
        $this->em->clear();

        $repository = $this->em->getRepository('CCDNUser\ProfileBundle\Tests\Functional\src\Entity\User');
        foreach ($userIds as $userId) {
            $storedUser = $repository->find($userId);
            $this->assertInstanceOf('CCDNUser\ProfileBundle\Entity\Profile', $storedUser->getProfile());
            $this->assertEquals($storedUser, $storedUser->getProfile()->getUser());
        }
    }
}
