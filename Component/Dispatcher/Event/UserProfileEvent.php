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

namespace CCDNUser\ProfileBundle\Component\Dispatcher\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

use CCDNUser\ProfileBundle\Entity\Profile;

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
class UserProfileEvent extends Event
{
    /**
     *
     * @access protected
     * @var \Symfony\Component\HttpFoundation\Request $request
     */
    protected $request;

    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Entity\Profile $profile
     */
    protected $profile;

    /**
     *
     * @access public
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \CCDNUser\ProfileBundle\Entity\Profile    $profile
     */
    public function __construct(Request $request, Profile $profile = null)
    {
        $this->request = $request;
        $this->profile = $profile;
    }

    /**
     *
     * @access public
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
