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
use CCDNUser\ProfileBundle\Entity\Profile;
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
class ProfileGateway extends BaseGateway implements ProfileGatewayInterface
{
    /**
     *
     * @access private
     * @var string $queryAlias
     */
    protected $queryAlias = 'p';

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                          $qb
     * @param  Array                                               $parameters
     * @return ProfileUserInterface
     */
    public function findProfile(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createSelectQuery();
        }

        return $this->one($qb, $parameters);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @param  Array                                        $parameters
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findProfiles(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createSelectQuery();
        }

        return $this->all($qb, $parameters);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @param  Array                      $parameters
     * @return int
     */
    public function countProfiles(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createCountQuery();
        }

        if (null == $parameters) {
            $parameters = array();
        }

        $qb->setParameters($parameters);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    /**
     *
     * @access public
     * @param  \CCDNUser\ProfileBundle\Entity\Profile                           $profile
     * @return \CCDNUser\ProfileBundle\Model\Component\Gateway\GatewayInterface
     */
    public function persistProfile(Profile $profile)
    {
        $this->persist($profile)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  \CCDNUser\ProfileBundle\Entity\Profile                           $profile
     * @return \CCDNUser\ProfileBundle\Model\Component\Gateway\GatewayInterface
     */
    public function updateProfile(Profile $profile)
    {
        $this->persist($profile)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  \CCDNUser\ProfileBundle\Entity\Profile                           $profile
     * @return \CCDNUser\ProfileBundle\Model\Component\Gateway\GatewayInterface
     */
    public function deleteProfile(Profile $profile)
    {
        $this->remove($profile)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Entity\Profile
     */
    public function createProfile()
    {
        return new $this->entityClass();
    }
}
