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

use CCDNUser\ProfileBundle\Model\Component\Gateway\ProfileGatewayInterface;
use CCDNUser\ProfileBundle\Entity\Profile;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
class ProfileManager extends BaseManager implements ProfileManagerInterface
{
    /**
     * @var ProfileGatewayInterface
     */
    protected $gateway;

    /**
     *
     * @access public
     * @param EventDispatcherInterface $dispatcher
     * @param ProfileGatewayInterface $gateway
     */
    public function __construct(EventDispatcherInterface $dispatcher, ProfileGatewayInterface $gateway)
    {
        parent::__construct($dispatcher, $gateway);
    }

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Entity\Profile
     */
    public function createProfile()
    {
        return $this->gateway->createProfile();
    }

    /**
     *
     * @access public
     * @param  \CCDNUser\ProfileBundle\Entity\Profile
     * @return $this
     */
    public function saveProfile(Profile $profile)
    {
        $this->gateway->updateProfile($profile);

        return $this;
    }

    /**
     *
     * @access public
     * @param \CCDNUser\ProfileBundle\Entity\Profile $profile
     * @return $this
     */
    public function updateProfile(Profile $profile)
    {
        $this->persist($profile);
        $this->flush();

        return $this;
    }
}
