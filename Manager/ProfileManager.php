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

use CCDNUser\ProfileBundle\Manager\ManagerInterface;
use CCDNUser\ProfileBundle\Manager\BaseManager;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class ProfileManager extends BaseManager implements ManagerInterface
{

    /**
     *
     * @access public
     * @param $profile
     * @return $this
     */
    public function update($profile)
    {
        // update the profile record
        $this->persist($profile);

        return $this;
    }

    /**
     *
     * @access public
     * @param $profile
     * @return $this
     */
    public function insert($profile)
    {
        $this->persist($profile);

        return $this;
    }
}
