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

namespace CCDNUser\ProfileBundle\Model\Repository;

use Doctrine\Common\Persistence\ObjectManager;
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
 */
interface RepositoryInterface
{
    /**
     *
     * @access public
     * @param  \Doctrine\Common\Persistence\ObjectManager             $em
     * @param  \CCDNUser\ProfileBundle\Model\Gateway\GatewayInterface $gateway
     */
    public function __construct(ObjectManager $em, GatewayInterface $gateway);

    /**
     *
     * @access public
     * @param  \CCDNUser\ProfileBundle\Model\Model\ModelInterface           $model
     * @return \CCDNUser\ProfileBundle\Model\Repository\RepositoryInterface
     */
    public function setModel(ModelInterface $model);

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Model\Gateway\GatewayInterface
     */
    public function getGateway();

    /**
     *
     * @access public
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder();

    /**
     *
     * @access public
     * @param  string                                       $column  = null
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createCountQuery($column = null, Array $aliases = null);

    /**
     *
     * @access public
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createSelectQuery(Array $aliases = null);

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function one(QueryBuilder $qb);

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function all(QueryBuilder $qb);
}
