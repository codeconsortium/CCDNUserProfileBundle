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

namespace CCDNUser\ProfileBundle\Model\Component\Gateway;

use Doctrine\ORM\QueryBuilder;
use CCDNUser\ProfileBundle\Entity\ProfileUserInterface;

/**
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
interface UserGatewayInterface extends GatewayInterface
{
    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @param  Array $parameters
     * @return int
     */
    public function countUsers(QueryBuilder $qb = null, $parameters = null);

    /**
     *
     * @access public
     * @param  ProfileUserInterface $user
     * @return UserGatewayInterface
     */
    public function persistUser(ProfileUserInterface $user);

    /**
     *
     * @access public
     * @param  ProfileUserInterface $user
     * @return UserGatewayInterface
     */
    public function updateUser(ProfileUserInterface $user);

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @param  Array $parameters
     * @return ProfileUserInterface
     */
    public function findUser(QueryBuilder $qb = null, $parameters = null);

    /**
     *
     * @access public
     * @param  ProfileUserInterface $user
     * @return UserGatewayInterface
     */
    public function deleteUser(ProfileUserInterface $user);

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @param  Array $parameters
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findUsers(QueryBuilder $qb = null, $parameters = null);

    /**
     *
     * @access public
     * @param QueryBuilder $qb
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAll(QueryBuilder $qb);
}
