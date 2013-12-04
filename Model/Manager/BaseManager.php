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

namespace CCDNUser\ProfileBundle\Model\Manager;

use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\QueryBuilder;
use CCDNUser\ProfileBundle\Model\Gateway\GatewayInterface;
use CCDNUser\ProfileBundle\Model\Model\ModelInterface;

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
abstract class BaseManager
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
     * @var \CCDNUser\ProfileBundle\Model\Manager\ManagerInterface $gateway
     */
    protected $gateway;

    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Model\Model\ModelInterface $model
     */
    protected $model;

    /**
     *
     * @access protected
     * @var \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher  $dispatcher
     */
    protected $dispatcher;

    /**
     *
     * @access public
     * @param \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher  $dispatcher
     * @param \Doctrine\Bundle\DoctrineBundle\Registry                          $doctrine
     * @param \Symfony\Component\Security\Core\SecurityContext                  $securityContext
     * @param \CCDNUser\ProfileBundle\Model\Gateway\GatewayInterface            $gateway
     */
    public function __construct(ContainerAwareEventDispatcher $dispatcher, Registry $doctrine, SecurityContext $securityContext, GatewayInterface $gateway)
    {
		$this->dispatcher = $dispatcher;
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getEntityManager();
        $this->securityContext = $securityContext;
        $this->gateway = $gateway;
    }

    /**
     *
     * @access public
     * @param  \CCDNUser\ProfileBundle\Model\Model\ModelInterface           $model
     * @return \CCDNUser\ProfileBundle\Model\Repository\RepositoryInterface
     */
    public function setModel(ModelInterface $model)
    {
        $this->model = $model;

        return $this;
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
     * @return \CCDNUser\ProfileBundle\Model\Gateway\GatewayInterface
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
     * @param  $entity
     * @return \CCDNUser\ProfileBundle\Model\Manager\ManagerInterface
     */
    public function persist($entity)
    {
        $this->em->persist($entity);

        return $this;
    }

    /**
     *
     * @access public
     * @param  $entity
     * @return \CCDNUser\ProfileBundle\Model\Manager\ManagerInterface
     */
    public function remove($entity)
    {
        $this->em->remove($entity);

        return $this;
    }

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Model\Manager\ManagerInterface
     */
    public function flush()
    {
        $this->em->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  $entity
     * @return \CCDNUser\ProfileBundle\Model\Manager\ManagerInterface
     */
    public function refresh($entity)
    {
        $this->em->refresh($entity);

        return $this;
    }
}
