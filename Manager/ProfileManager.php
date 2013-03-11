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

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
     * @return self
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
     * @return self
     */
    public function insert($profile)
    {
        $this->persist($profile);

        return $this;
    }
	
	public function connectProfileWithUser($user)
	{
		$profile = $user->getProfile();
		
		$profile->setUser($user);
		$user->setProfile($profile);		
					
		$this->persist($user, $profile);
		$this->flush();
		
		$this->refresh($user, $profile);
		
		return $profile;
	}

	
	/**
	 *
	 * @access protected
	 * @param $profileId
	 * @return Profile
	 */
	protected function getProfileById($profileId)
	{
		$profile = $this->em->createQueryBuilder()
			->select('p')
			->from('CCDNUserProfileBundle:Profile', 'p')
			->where('p.id = :id')
			->setParameters(
				array(
					':id' => $profileId,
				)
			)
			->getQuery()
			->getSingleResult();
				
		return $profile;
	}
	
	/**
	 *
	 * @access public
	 * @param $profileId
	 * @param $securityContext
	 * @return Profile
	 */
	public function getProfile($profileId, $securityContext)
	{
		if ($profileId == null || $profileId == 0 || ! is_numeric($profileId)) {
            if ( ! $securityContext->isGranted('ROLE_USER')) {
                throw new NotFoundHttpException('User not found!');
            }
			
			$user = $securityContext->getToken()->getUser();
			$profile = $this->connectProfileWithUser($user);
			
			//$profile = $user->getProfile();
			//
			//if (null == $profile->getId()) {			
			//	$profile->setUser($user);
			//	$user->setProfile($profile);
			//		
			//	$this->persist($user, $profile);
			//	$this->flush();
			//}
		} else {
			$profile = $this->getProfileById($profileId);			
		}
		
        if (! $profile) {
            throw new NotFoundHttpException('User not found!');
        }

		$profile = $this->getProfileProvider()->setup($profile);
		
		return $profile;
	}
}
