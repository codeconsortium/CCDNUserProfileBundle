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

use Symfony\Component\Security\Core\User\UserInterface;
use CCDNUser\ProfileBundle\Model\FrontModel\BaseModel;
use CCDNUser\ProfileBundle\Model\FrontModel\ModelInterface;

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
        return $this->getRepository()->findAllUsersWithProfilePaginated($page, $itemsPerPage);
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
        return $this->getRepository()->findAllUsersWithProfileFilteredAtoZPaginated($alpha, $page, $itemsPerPage);
    }

    /**
     *
     * @access public
     * @param  string                                              $username
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function findOneUserWithProfileByUsername($username)
    {
        return $this->getRepository()->findOneUserWithProfileByUsername($username);
    }

    /**
     *
     * @access public
     * @param  int                                                 $userId
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function findOneUserWithProfileById($userId)
    {
        return $this->getRepository()->findOneUserWithProfileById($userId);
    }
}
