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

namespace CCDNUser\ProfileBundle\Entity\Model;

use Symfony\Component\Security\Core\User\UserInterface;

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
abstract class ProfileModel
{
    /**
     *
     * @access protected
     * @var Symfony\Component\Security\Core\User\UserInterface $user
     */
    protected $user;

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param  UserInterface $user
     * @return Profile
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        if (null !== $this->user) {
            $this->user->setProfile($this);
        }

        return $this;
    }
}
