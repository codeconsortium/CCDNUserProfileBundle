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

namespace CCDNUser\ProfileBundle\Model\Component\Manager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use CCDNUser\ProfileBundle\Model\Component\Gateway\ProfileGatewayInterface;
use CCDNUser\ProfileBundle\Entity\Profile;

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
interface ProfileManagerInterface extends ManagerInterface
{
    /**
     *
     * @access public
     * @param EventDispatcherInterface $dispatcher
     * @param ProfileGatewayInterface $gateway
     */
    public function __construct(EventDispatcherInterface $dispatcher, ProfileGatewayInterface $gateway);

    /**
     *
     * @access public
     * @return Profile
     */
    public function createProfile();

    /**
     *
     * @access public
     * @param  Profile $profile
     */
    public function saveProfile(Profile $profile);

    /**
     *
     * @access public
     * @param Profile $profile
     */
    public function updateProfile(Profile $profile);
}
