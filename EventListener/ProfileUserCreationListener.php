<?php

namespace CCDNUser\ProfileBundle\EventListener;

use CCDNUser\ProfileBundle\Entity\Profile;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Listens to the creation of ProfileUser
 *
 * @todo license
 * @todo relying on the Symfony UserInterface in this case is incorrect, as we are expecting an object that has a
 * `setProfile` method
 */
class ProfileUserCreationListener
{
    /**
     * @todo move creation of default profile to a facade that does not rely on a doctrine connection.
     * The creation can NOT be taken care of by a service that relies on Doctrine: this results in a circular service
     * definition.
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof UserInterface) {
            $profile = new Profile();
            $profile->setUser($entity);
            $entity->setProfile($profile);
        }
    }
}
 