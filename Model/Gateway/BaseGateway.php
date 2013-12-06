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

namespace CCDNUser\ProfileBundle\Model\Gateway;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\QueryBuilder;

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
abstract class BaseGateway
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
     * @var $paginator
     */
    protected $paginator;
	
    /**
     *
     * @access protected
     * @var \Doctrine\ORM\EntityManager $em
     */
    protected $em;

    /**
     *
     * @access private
     * @var string $entityClass
     */
    protected $entityClass;

    /**
     *
     * @access private
     * @var string $pagerTheme
     */
    protected $pagerTheme;

    /**
     *
     * @access public
     * @param  \Doctrine\Bundle\DoctrineBundle\Registry                   $doctrine
     * @param  string                                                     $entityClass
     * @param  string                                                     $pagerTheme
     */
    public function __construct(Registry $doctrine, $paginator, $entityClass, $pagerTheme)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getEntityManager();
		$this->paginator = $paginator;

        if (null == $entityClass) {
            throw new \Exception('Entity class for gateway must be specified!');
        }

        $this->entityClass = $entityClass;
		$this->pagerTheme = $pagerTheme;
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     *
     * @access public
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->em->createQueryBuilder();
    }

    /**
     *
     * @access public
     * @param  Array                      $aliases = null
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createSelectQuery(Array $aliases = null)
    {
        if (null == $aliases || ! is_array($aliases)) {
            $aliases = array($this->queryAlias);
        }

        if (! in_array($this->queryAlias, $aliases)) {
            $aliases = array($this->queryAlias) + $aliases;
        }

        return $this->getQueryBuilder()->select($aliases)->from($this->entityClass, $this->queryAlias);
    }

    /**
     *
     * @access public
     * @param  string                     $column  = null
     * @param  Array                      $aliases = null
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createCountQuery($column = null, Array $aliases = null)
    {
        if (null == $column) {
            $column = 'count(' . $this->queryAlias . '.id)';
        }

        if (null == $aliases || ! is_array($aliases)) {
            $aliases = array($column);
        }

        if (! in_array($column, $aliases)) {
            $aliases = array($column) + $aliases;
        }

        return $this->getQueryBuilder()->select($aliases)->from($this->entityClass, $this->queryAlias);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @param  Array                                        $parameters
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function one(QueryBuilder $qb, $parameters = array())
    {
        if (count($parameters)) {
            $qb->setParameters($parameters);
        }

        try {
            return $qb->getQuery()->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @param  Array                                        $parameters
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function all(QueryBuilder $qb, $parameters = array())
    {
        if (count($parameters)) {
            $qb->setParameters($parameters);
        }

        try {
            return $qb->getQuery()->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                               $qb
     * @param  int                                                      $itemsPerPage
     * @param  int                                                      $page
     * @return \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination
     */
    public function paginateQuery(QueryBuilder $qb, $itemsPerPage, $page)
    {
		$pager = $this->paginator->paginate($qb, $page, $itemsPerPage);
        $pager->setTemplate($this->pagerTheme);
		
		return $pager;
    }

    /**
     *
     * @access public
     * @param  Object                                                 $entity
     * @return \CCDNUser\ProfileBundle\Model\Gateway\GatewayInterface
     */
    public function persist($entity)
    {
        $this->em->persist($entity);

        return $this;
    }

    /**
     *
     * @access public
     * @param  Object                                                 $entity
     * @return \CCDNUser\ProfileBundle\Model\Gateway\GatewayInterface
     */
    public function remove($entity)
    {
        $this->em->remove($entity);

        return $this;
    }

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Model\Gateway\GatewayInterface
     */
    public function flush()
    {
        $this->em->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  Object                                                 $entity
     * @return \CCDNUser\ProfileBundle\Model\Gateway\GatewayInterface
     */
    public function refresh($entity)
    {
        $this->em->refresh($entity);

        return $this;
    }
}
