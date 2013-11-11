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

namespace CCDNUser\ProfileBundle\Model\Model;

use Symfony\Component\Security\Core\User\UserInterface;

use CCDNUser\ProfileBundle\Model\Model\BaseModel;
use CCDNUser\ProfileBundle\Model\Model\ModelInterface;
use CCDNUser\ProfileBundle\Entity\Profile;

/**
 *
 * @category CCDNUser
 * @package  ProfileBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserProfileBundle
 *
 */
class UserModel extends BaseModel implements ModelInterface
{
    /**
     *
     * @access public
     * @param  int                                          $page
     * @param  int                                          $itemsPerPage
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllUsersWithProfilePaginated($page = 1, $itemsPerPage = 25)
    {
        $pager = $this->getRepository()->findAllUsersWithProfilePaginated($page = 1, $itemsPerPage = 25);
		
		$users = $pager->getItems();
		foreach ($users as $user) {
			$this->checkUserHasProfile($user);
		}
		
		return $pager;
    }

    /**
     *
     * @access public
     * @param  char                                         $alpha
     * @param  int                                          $page
     * @param  int                                          $itemsPerPage
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllUsersWithProfileFilteredAtoZPaginated($alpha, $page = 1, $itemsPerPage = 25)
	{
        $pager = $this->getRepository()->findAllUsersWithProfileFilteredAtoZPaginated($alpha, $page = 1, $itemsPerPage = 25);
		
		$users = $pager->getItems();
		foreach ($users as $user) {
			$this->checkUserHasProfile($user);
		}
		
		return $pager;
	}

    /**
     *
     * @access public
     * @param  int                                                 $userId
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function findOneUserWithProfile($userId)
	{
		if (is_numeric($userId)) {
			$user = $this->findOneUserWithProfileById($userId);
		} else {
			$user = $this->findOneUserWithProfileByUsername($userId);
		}
		
		return $user;
	}

    /**
     *
     * @access public
     * @param  string                                              $username
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
	public function findOneUserWithProfileByUsername($username)
	{
		$user = $this->getRepository()->findOneUserWithProfileByUsername($username);
		
		$this->checkUserHasProfile($user);
		
		return $user;
	}

    /**
     *
     * @access public
     * @param  int                                                 $userId
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
	public function findOneUserWithProfileById($userId)
	{
		$user = $this->getRepository()->findOneUserWithProfileById($userId);
		
		$this->checkUserHasProfile($user);
		
		return $user;
	}

	/**
	 * 
	 * @access public
	 * @param  \Symfony\Component\Security\Core\User\UserInterface $user
	 */
	public function checkUserHasProfile(UserInterface $user)
	{
		return $this->getManager()->checkUserHasProfile($user);
	}

	/**
	 * 
	 * @access public
	 * @param  \CCDNUser\ProfileBundle\Entity\Profile $profile
	 */
	public function updateProfile(Profile $profile)
	{
		return $this->getManager()->updateProfile($profile);
	}
}
