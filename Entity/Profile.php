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

use CCDNUser\ProfileBundle\Model\Profile as AbstractProfile;

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
class Profile extends AbstractProfile
{
    /**
     *
     * @access protected
     * @var integer $id
     */
    protected $id;

    /**
     *
     * @access protected
     * @var Boolean $avatarIsRemote
     */
    protected $avatarIsRemote = false;

    /**
     *
     * @access protected
     * @var string $avatar
     */
    protected $avatar;

    /**
     *
     * @access protected
     * @var string $aim
     */
    protected $aim;

    /**
     *
     * @access protected
     * @var Boolean $aimIsPublic
     */
    protected $aimIsPublic = false;

    /**
     *
     * @access protected
     * @var string $msn
     */
    protected $msn;

    /**
     *
     * @access protected
     * @var Boolean $msnIsPublic
     */
    protected $msnIsPublic = false;

    /**
     *
     * @access protected
     * @var string $icq
     */
    protected $icq;

    /**
     *
     * @access protected
     * @var Boolean $icqIsPublic
     */
    protected $icqIsPublic = false;

    /**
     *
     * @access protected
     * @var string $yahoo
     */
    protected $yahoo;

    /**
     *
     * @access protected
     * @var Boolean $yahooIsPublic
     */
    protected $yahooIsPublic = false;

    /**
     *
     * @access protected
     * @var string $website
     */
    protected $website;

    /**
     *
     * @access protected
     * @var string $location
     */
    protected $location;

    /**
     *
     * @access protected
     * @var string $bio
     */
    protected $bio;

    /**
     *
     * @access protected
     * @var string $signature
     */
    protected $signature;

    /**
     *
     * @access protected
     * @var array $contactPoints
     */
    protected $contactPoints = array(
            'msn' => array(
                'contact' => 'getMsn',
                'is_public' => 'getMsnIsPublic',
            ),
            'aim' => array(
                'contact' => 'getAim',
                'is_public' => 'getAimIsPublic',
            ),
            'icq' => array(
                'contact' => 'getIcq',
                'is_public' => 'getIcqIsPublic',
            ),
            'yahoo' => array(
                'contact' => 'getYahoo',
                'is_public' => 'getYahooIsPublic',
            ),
        );

    /**
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get avatarIsRemote
     *
     * @return boolean
     */
    public function getAvatarIsRemote()
    {
        return $this->avatarIsRemote;
    }

    /**
     * Set avatarIsRemote
     *
     * @param  boolean $avatarIsRemote
     * @return Profile
     */
    public function setAvatarIsRemote($avatarIsRemote)
    {
        $this->avatarIsRemote = $avatarIsRemote;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set avatar
     *
     * @param  string  $avatar
     * @return Profile
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get aim
     *
     * @return string
     */
    public function getAim()
    {
        return $this->aim;
    }

    /**
     * Set aim
     *
     * @param  string  $aim
     * @return Profile
     */
    public function setAim($aim)
    {
        $this->aim = $aim;

        return $this;
    }

    /**
     * Get aimIsPublic
     *
     * @return boolean
     */
    public function getAimIsPublic()
    {
        return $this->aimIsPublic;
    }

    /**
     * Set aimIsPublic
     *
     * @param  boolean $aimIsPublic
     * @return Profile
     */
    public function setAimIsPublic($aimIsPublic)
    {
        $this->aimIsPublic = $aimIsPublic;

        return $this;
    }

    /**
     * Get msn
     *
     * @return string
     */
    public function getMsn()
    {
        return $this->msn;
    }

    /**
     * Set msn
     *
     * @param  string  $msn
     * @return Profile
     */
    public function setMsn($msn)
    {
        $this->msn = $msn;

        return $this;
    }

    /**
     * Get msnIsPublic
     *
     * @return boolean
     */
    public function getMsnIsPublic()
    {
        return $this->msnIsPublic;
    }

    /**
     * Set msnIsPublic
     *
     * @param  boolean $msnIsPublic
     * @return Profile
     */
    public function setMsnIsPublic($msnIsPublic)
    {
        $this->msnIsPublic = $msnIsPublic;

        return $this;
    }

    /**
     * Get icq
     *
     * @return string
     */
    public function getIcq()
    {
        return $this->icq;
    }

    /**
     * Set icq
     *
     * @param  string  $icq
     * @return Profile
     */
    public function setIcq($icq)
    {
        $this->icq = $icq;

        return $this;
    }

    /**
     * Get icqIsPublic
     *
     * @return boolean
     */
    public function getIcqIsPublic()
    {
        return $this->icqIsPublic;
    }

    /**
     * Set icqIsPublic
     *
     * @param  boolean $icqIsPublic
     * @return Profile
     */
    public function setIcqIsPublic($icqIsPublic)
    {
        $this->icqIsPublic = $icqIsPublic;

        return $this;
    }

    /**
     * Get yahoo
     *
     * @return string
     */
    public function getYahoo()
    {
        return $this->yahoo;
    }

    /**
     * Set yahoo
     *
     * @param  string  $yahoo
     * @return Profile
     */
    public function setYahoo($yahoo)
    {
        $this->yahoo = $yahoo;

        return $this;
    }

    /**
     * Get yahooIsPublic
     *
     * @return boolean
     */
    public function getYahooIsPublic()
    {
        return $this->yahooIsPublic;
    }

    /**
     * Set yahooIsPublic
     *
     * @param  boolean $yahooIsPublic
     * @return Profile
     */
    public function setYahooIsPublic($yahooIsPublic)
    {
        $this->yahooIsPublic = $yahooIsPublic;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set website
     *
     * @param  string  $website
     * @return Profile
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set location
     *
     * @param  string  $location
     * @return Profile
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get bio
     *
     * @return text
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set bio
     *
     * @param  text    $bio
     * @return Profile
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set signature
     *
     * @param  string  $signature
     * @return Profile
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }
}
