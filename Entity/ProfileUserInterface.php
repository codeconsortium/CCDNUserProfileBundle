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

namespace CCDNUser\ProfileBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

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
interface ProfileUserInterface extends UserInterface
{
    /**
     * Set profile
     *
     * @param Profile $profile
     */
    public function setProfile(Profile $profile);

    /**
     * Get profile
     *
     * @return Profile
     */
    public function getProfile();

    /**
     * Get registered date
     *
     * @return \Datetime
     */
    public function getRegisteredDate();

    /**
     * Set registered date
     *
     * @param  \Datetime $registeredDate
     */
    public function setRegisteredDate(\Datetime $registeredDate);
}
