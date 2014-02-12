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

namespace CCDNUser\ProfileBundle\Model\FrontModel;

use CCDNUser\ProfileBundle\Model\Component\Manager\UserManagerInterface;
use CCDNUser\ProfileBundle\Model\Component\Repository\UserRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use CCDNUser\ProfileBundle\Entity\ProfileUserInterface;

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
class UserModel extends BaseModel implements UserModelInterface
{
    /**
     * @access public
     * @param EventDispatcherInterface $dispatcher
     * @param UserRepositoryInterface $repository
     * @param UserManagerInterface $manager
     */
    public function __construct(
        EventDispatcherInterface $dispatcher,
        UserRepositoryInterface $repository,
        UserManagerInterface $manager
    ) {
        parent::__construct($dispatcher, $repository, $manager);
    }

    /**
     *
     * @access public
     * @param  int                                          $page
     * @param  int                                          $itemsPerPage
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllUsersWithProfilePaginated($page = 1, $itemsPerPage = 25)
    {
        return $this->getRepository()->findAllUsersWithProfilePaginated($page, $itemsPerPage);
    }

    /**
     *
     * @access public
     * @param  string                                       $alpha
     * @param  int                                          $page
     * @param  int                                          $itemsPerPage
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllUsersWithProfileFilteredAtoZPaginated($alpha, $page = 1, $itemsPerPage = 25)
    {
        return $this->getRepository()->findAllUsersWithProfileFilteredAtoZPaginated($alpha, $page, $itemsPerPage);
    }

    /**
     *
     * @access public
     * @param  string $username
     * @return ProfileUserInterface
     */
    public function findOneUserWithProfileByUsername($username)
    {
        return $this->getRepository()->findOneUserWithProfileByUsername($username);
    }

    /**
     *
     * @access public
     * @param  int $userId
     * @return ProfileUserInterface
     */
    public function findOneUserWithProfileById($userId)
    {
        return $this->getRepository()->findOneUserWithProfileById($userId);
    }

    /**
     * Returns users that do not have a profile attached.
     *
     * @access public
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllUsersWithoutProfiles()
    {
        return $this->getRepository()->findAllUsersWithoutProfiles();
    }

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function saveUser(UserInterface $user)
    {
        $this->getManager()->saveUser($user);
        return $this;
    }

    /**
     * @return UserRepositoryInterface
     */
    public function getRepository()
    {
        return parent::getRepository();
    }

    /**
     * @return UserManagerInterface
     */
    public function getManager()
    {
        return parent::getManager();
    }
}
