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

namespace CCDNUser\ProfileBundle\Model\Component\Repository;

use CCDNUser\ProfileBundle\Model\Component\Gateway\UserGatewayInterface;
use CCDNUser\ProfileBundle\Entity\ProfileUserInterface;

/**
 * ProfileRepository
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
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     *
     * @access public
     * @param UserGatewayInterface $gateway
     */
    public function __construct(UserGatewayInterface $gateway);

    /**
     *
     * @access public
     * @param  int $userId
     * @return ProfileUserInterface
     */
    public function findOneUserWithProfileById($userId);

    /**
     *
     * @access public
     * @param  string $username
     * @return ProfileUserInterface
     */
    public function findOneUserWithProfileByUsername($username);

    /**
     *
     * @access public
     * @param  int $page
     * @param  int $itemsPerPage
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllUsersWithProfilePaginated($page = 1, $itemsPerPage = 25);

    /**
     *
     * @access public
     * @param  string $alpha
     * @param  int $page
     * @param  int $itemsPerPage
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllUsersWithProfileFilteredAtoZPaginated($alpha, $page = 1, $itemsPerPage = 25);
}
