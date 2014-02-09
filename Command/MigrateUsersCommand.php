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

namespace CCDNUser\ProfileBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use CCDNUser\ProfileBundle\Entity\Factory\ProfileFactoryInterface;
use CCDNUser\ProfileBundle\Model\FrontModel\UserModel;
use CCDNUser\ProfileBundle\Model\FrontModel\ProfileModel;

/**
 * Locates users without an attached profile, and attaches a default profile to them.
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
class MigrateUsersCommand extends Command
{
    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var ProfileModel
     */
    private $profileModel;

    /**
     * @var ProfileFactoryInterface
     */
    private $profileFactory;

    public function __construct(
        UserModel $userModel,
        ProfileModel $profileModel,
        ProfileFactoryInterface $profileFactory
    ) {
        parent::__construct();

        $this->userModel = $userModel;
        $this->profileModel = $profileModel;
        $this->profileFactory = $profileFactory;
    }

    protected function configure()
    {
        parent::configure();

        $this->setName('ccdn-user-profile:migrate-users')
            ->setDescription('Creates a default profile for users without a profile.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return null
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        // Locate users without a profile.
        $profilelessUsers = $this->userModel->findAllUsersWithoutProfiles();
        $output->writeln(sprintf('Migrating %d users without profiles.', count($profilelessUsers)));

        // Attach a profile to each of them.
        foreach ($profilelessUsers as $user) {
            $profile = $this->profileFactory->createDefaultProfile();
            $profile->setUser($user);
            $user->setProfile($profile);
            $this->userModel->saveUser($user);
            $this->profileModel->saveProfile($profile);
        }

        // Notify the user we're done.
        $output->writeln(sprintf('Migrated %d users without profiles.', count($profilelessUsers)));
    }
}
