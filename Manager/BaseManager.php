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

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\SecurityContext;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\QueryBuilder;

use CCDNUser\ProfileBundle\Manager\BaseManagerInterface;
use CCDNUser\ProfileBundle\Gateway\BaseGatewayInterface;

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
 * @abstract
 */
abstract class BaseManager implements BaseManagerInterface
{
    /**
     *
     * @access protected
     * @var \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     */
    protected $doctrine;

    /**
     *
     * @access protected
     * @var \Doctrine\ORM\EntityManager $em
     */
    protected $em;

    /**
     *
     * @access protected
     * @var \Symfony\Component\Security\Core\SecurityContext $securityContext
     */
    protected $securityContext;

    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Manager\BaseManagerInterface $gateway
     */
    protected $gateway;

    /**
     *
     * @access protected
     */
    protected $profileProvider;

    /**
     *
     * @access public
     * @param \Doctrine\Bundle\DoctrineBundle\Registry             $doctrine
     * @param \Symfony\Component\Security\Core\SecurityContext     $securityContext
     * @param \CCDNUser\ProfileBundle\Gateway\BaseGatewayInterface $gateway
     */
    public function __construct(Registry $doctrine, SecurityContext $securityContext, BaseGatewayInterface $gateway, $profileProvider)
    {
        $this->doctrine = $doctrine;

        $this->em = $doctrine->getEntityManager();

        $this->securityContext = $securityContext;

        $this->gateway = $gateway;

        $this->profileProvider = $profileProvider;
    }

    /**
     *
     * @access public
     * @return ProfileProvider
     */
    public function getProfileProvider()
    {
        return $this->profileProvider;
    }

    /**
     *
     * @access public
     * @param  string $role
     * @return bool
     */
    public function isGranted($role)
    {
        return $this->securityContext->isGranted($role);
    }

    /**
     *
     * @access public
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser()
    {
        return $this->securityContext->getToken()->getUser();
    }

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Gateway\BaseGatewayInterface
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     *
     * @access public
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->gateway->getQueryBuilder();
    }

    /**
     *
     * @access public
     * @param  string                                       $column  = null
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createCountQuery($column = null, Array $aliases = null)
    {
        return $this->gateway->createCountQuery($column, $aliases);
    }

    /**
     *
     * @access public
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createSelectQuery(Array $aliases = null)
    {
        return $this->gateway->createSelectQuery($aliases);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function one(QueryBuilder $qb)
    {
        return $this->gateway->one($qb);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function all(QueryBuilder $qb)
    {
        return $this->gateway->all($qb);
    }

    /**
     *
     * @access public
     * @param $entity
     * @return \CCDNUser\ProfileBundle\Manager\BaseManagerInterface
     */
    public function persist($entity)
    {
        $this->em->persist($entity);

        return $this;
    }

    /**
     *
     * @access public
     * @param $entity
     * @return \CCDNUser\ProfileBundle\Manager\BaseManagerInterface
     */
    public function remove($entity)
    {
        $this->em->remove($entity);

        return $this;
    }

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Manager\BaseManagerInterface
     */
    public function flush()
    {
        $this->em->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param $entity
     * @return \CCDNUser\ProfileBundle\Manager\BaseManagerInterface
     */
    public function refresh($entity)
    {
        $this->em->refresh($entity);

        return $this;
    }
}
