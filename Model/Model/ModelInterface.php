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

namespace CCDNUser\ProfileBundle\Model\Model;

use CCDNUser\ProfileBundle\Model\Manager\ManagerInterface;
use CCDNUser\ProfileBundle\Model\Repository\RepositoryInterface;

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
interface ModelInterface
{
    /**
     *
     * @access public
     * @param \CCDNUser\ProfileBundle\Model\Repository\RepositoryInterface $repository
     * @param \CCDNUser\ProfileBundle\Model\Manager\ManagerInterface       $manager
     */
    public function __construct(RepositoryInterface $repository, ManagerInterface $manager);

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Model\Repository\RepositoryInterface
     */
    public function getRepository();

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Model\Manager\ManagerInterface
     */
    public function getManager();
}
