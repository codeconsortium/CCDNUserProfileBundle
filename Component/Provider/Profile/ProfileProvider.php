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

namespace CCDNUser\ProfileBundle\Component\Provider\Profile;

use Symfony\Component\Security\Core\User\UserInterface;
use CCDNComponent\CommonBundle\Component\Provider\Profile\ProfileProviderInterface;
use CCDNComponent\CommonBundle\Component\Provider\Profile\ProfileInterface;

class ProfileProvider implements ProfileProviderInterface
{
	/** @var $container */
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

	/**
	 *
	 * @access public
	 * @param UserInterface $user
	 * @return Profile $profile
	 */
    public function transform(UserInterface $user = null)
    {
		$profile = $user->getProfile();
		
		if (null == $profile->getId()) {
			$manager = $this->container->get('ccdn_user_profile.manager.profile');

			$profile = $manager->connectProfileWithUser($user);
		}
		
		// Choose username, wether canonical or email or some other field.
        if (null !== $user) {
            $profile->setUsername($user->getUsername());
        } else {
            $profile->setUsername('Guest');
        }

		// Set the router object and route path.
		$profile->setRouter($this->container->get('router'));

		// Set avatar.
        $asset = $this->container->get('templating.helper.assets');

        $fallbackAvatar = $asset->getUrl($this->container->getParameter('ccdn_component_common.component.provider.profile.avatar_fallback'));
        $profile->setAvatarFallback($fallbackAvatar);

		// Set role badges.
        $profile->autoSetRoleBadge();

        return $profile;
    }

	/**
	 *
	 * @access public
	 * @param UserInterface $user
	 * @return Profile $profile
	 */
    public function setup(ProfileInterface $profile = null)
    {	
        if (null == $profile) {
			throw new \Exception('You must provide a Profile to transform.');
        } else {
			if (null == $profile->getId()) {
				throw new \Exception('Profile has no valid id.');
			}
        }

		// Set the router object and route path.
		$profile->setRouter($this->container->get('router'));

		// Set avatar.
        $asset = $this->container->get('templating.helper.assets');

        $fallbackAvatar = $asset->getUrl($this->container->getParameter('ccdn_component_common.component.provider.profile.avatar_fallback'));
        $profile->setAvatarFallback($fallbackAvatar);

		// Set role badges.
        $profile->autoSetRoleBadge();

        return $profile;
    }
}