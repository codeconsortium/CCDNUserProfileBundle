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

namespace CCDNUser\ProfileBundle\EventListener;

use CCDNUser\ProfileBundle\Entity\Factory\ProfileFactoryInterface;
use CCDNUser\ProfileBundle\Entity\ProfileUserInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Listens to the creation of Symfony users and attaches a default profile.
 *
 * @category CCDNUser
 * @package  ProfileBundle
 *
 * @author   Maarten Jacobs <maarten.j.jacobs@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserProfileBundle
 *
 * @todo relying on the Symfony UserInterface in this case is incorrect, as we are expecting an object that has a
 * `setProfile` method
 */
class ProfileUserCreationListener
{
    /**
     * @var ProfileFactoryInterface
     */
    private $profileFactory;

    /**
     * @param ProfileFactoryInterface $profileFactory
     */
    public function __construct(ProfileFactoryInterface $profileFactory)
    {
        $this->profileFactory = $profileFactory;
    }

    /**
     * Listens to the prePersist event for Symfony users and attaches a default profile.
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof ProfileUserInterface) {
            $profile = $this->profileFactory->createDefaultProfile();
            $profile->setUser($entity);
            $entity->setProfile($profile);
        }
    }
}
 