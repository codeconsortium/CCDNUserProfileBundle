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

namespace CCDNUser\ProfileBundle\Manager;

use CCDNUser\ProfileBundle\Manager\ManagerInterface;
use CCDNUser\ProfileBundle\Manager\BaseManager;

use CCDNUser\ProfileBundle\Entity\Profile;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class ProfileManager extends BaseManager implements ManagerInterface
{

    /**
     *
     * @access public
     * @param $profile
     * @return $this
     */
    public function update($profile)
    {
        // update the profile record
        $this->persist($profile);

        return $this;
    }

    /**
     *
     * @access public
     * @param $profile
     * @return $this
     */
    public function insert($profile)
    {
        $this->persist($profile);

        return $this;
    }

	/**
	 *
	 * @access public
	 * @param $user
	 * @return $this
	 */
	public function checkHasProfile($user)
	{
		
		// Fix User not having Profile.
        if ( ! $user->getProfile()->getId()) {
        	
			// Check if a profile already exists that matches the user on
			// its foreign key before making a new one, if so relink it.
			$profile = $this->repository->findOneByUser($user->getId());

			if (! is_object($profile) || ! ($profile instanceof Profile)) {
				$profile = new Profile();
								
    			$this->insert($profile)->flush();

				$this->refresh($profile);
			}

			// Inform the user of there new profile.
			$user->setProfile($profile);
				
			$this->persist($user)->flush();
			
			// Refresh the user.
			$this->refresh($user);
		}
		
		// Fix Profile not linking back to User.
		if ( ! $user->getProfile()->getUser()) {
			
			$profile = $user->getProfile();
			
			$profile->setUser($user);
			
			$this->update($profile)->flush();
        }
	}
	
}
