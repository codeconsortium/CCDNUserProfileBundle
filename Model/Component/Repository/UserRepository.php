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

use CCDNUser\ProfileBundle\Model\Component\Repository\BaseRepository;
use CCDNUser\ProfileBundle\Model\Component\Repository\RepositoryInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * ProfileRepository
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
class UserRepository extends BaseRepository implements RepositoryInterface
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
        $qb = $this->createSelectQuery(array('u'));

        $qb
            ->join('u.profile', 'p')
            ->addOrderBy('u.username', 'DESC')
            ->addOrderBy('u.registeredDate', 'DESC')
        ;

        return $this->gateway->paginateQuery($qb, $itemsPerPage, $page);
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
        $qb = $this->createSelectQuery(array('u'));

        $params = array(':filter' => $alpha . '%');

        $qb
            ->where('u.username LIKE :filter')
            ->join('u.profile', 'p')
            ->setParameters($params)
            ->addOrderBy('u.username', 'DESC')
            ->addOrderBy('u.registeredDate', 'DESC')
        ;

        return $this->gateway->paginateQuery($qb, $itemsPerPage, $page);
    }

    /**
     *
     * @access public
     * @param  string                                              $username
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function findOneUserWithProfileByUsername($username)
    {
        $qb = $this->createSelectQuery(array('u'));

        $params = array(':username' => $username);

        $qb
            ->where('u.username = :username')
            ->join('u.profile', 'p')
            ->addOrderBy('u.username', 'DESC')
            ->addOrderBy('u.registeredDate', 'DESC')
        ;

        return $this->gateway->findUser($qb, $params);
    }

    /**
     *
     * @access public
     * @param  int                                                 $userId
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function findOneUserWithProfileById($userId)
    {
        $qb = $this->createSelectQuery(array('u'));

        $params = array(':userId' => $userId);

        $qb
            ->where('u.id = :userId')
            ->join('u.profile', 'p')
            ->addOrderBy('u.username', 'DESC')
            ->addOrderBy('u.registeredDate', 'DESC')
        ;

        return $this->gateway->findUser($qb, $params);
    }

    public function findAllUsersWithoutProfiles()
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createSelectQuery(array('u'));
        $qb
            ->leftJoin('u.profile', 'p')
            ->where('p.id IS NULL')
        ;
        return $this->gateway->findAll($qb);
    }
}
