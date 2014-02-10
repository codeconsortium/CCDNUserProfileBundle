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
        $pager = $this->getRepository()->findAllUsersWithProfilePaginated($page, $itemsPerPage);

        $users = $pager->getItems();
        foreach ($users as $user) {
            $this->checkUserHasProfile($user);
        }

        return $pager;
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
        $pager = $this->getRepository()->findAllUsersWithProfileFilteredAtoZPaginated($alpha, $page, $itemsPerPage);

        $users = $pager->getItems();
        foreach ($users as $user) {
            $this->checkUserHasProfile($user);
        }

        return $pager;
    }

    /**
     *
     * @access public
     * @param  string $username
     * @return ProfileUserInterface
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
     * @param  int $userId
     * @return ProfileUserInterface
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
     * @param ProfileUserInterface $user
     */
    public function checkUserHasProfile(ProfileUserInterface $user)
    {
        return $this->getManager()->checkUserHasProfile($user);
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
