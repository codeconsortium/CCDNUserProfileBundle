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
use Doctrine\ORM\Mapping as ORM;

use CCDNUser\ProfileBundle\Model\Profile as AbstractProfile;

class Profile extends AbstractProfile
{
	/** @var integer $id */
    protected $id;

    /** @var Boolean $avatarIsRemote*/
    protected $avatarIsRemote = false;

    /** @var string $avatar */
    protected $avatar;

    /** @var string $aim */
    protected $aim;

    /** @var Boolean $aimIsPublic */
    protected $aimIsPublic = false;

    /** @var string $msn */
    protected $msn;

    /** @var Boolean $msnIsPublic */
    protected $msnIsPublic = false;

    /** @var string $icq */
    protected $icq;

    /** @var Boolean $icqIsPublic */
    protected $icqIsPublic = false;

    /** @var string $yahoo */
    protected $yahoo;

    /** @var Boolean $yahooIsPublic */
    protected $yahooIsPublic = false;

    /** @var string $website */
    protected $website;

    /** @var string $location */
    protected $location;

    /** @var string $bio */
    protected $bio;

    /** @var string $signature */
    protected $signature;

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
     * Set avatarIsRemote
     *
     * @param boolean $avatarIsRemote
     */
    public function setAvatarIsRemote($avatarIsRemote)
    {
        $this->avatarIsRemote = $avatarIsRemote;
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
     * Set avatar
     *
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
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
     * @param int $scaleX
     * @param int $scaleY
     * @param string $class
     * @return string
     */
    public function renderAvatar($scaleX = 100, $scaleY = 100, $class = null)
    {
        $scaleX     = ($scaleX) ? $scaleX : 100;
        $scaleY     = ($scaleY) ? $scaleY : 100;
		$class 		= 'class="avatar' . (($class) ? (' ' . $class): '') . '"';

        return '<img ' . $class . ' width="' . $scaleX . '" height="' . $scaleY . '" src="' . $this->avatar . '" alt="avatar" />';
    }
	
    /**
     * Set aim
     *
     * @param string $aim
     */
    public function setAim($aim)
    {
        $this->aim = $aim;
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
     * Set aimIsPublic
     *
     * @param boolean $aimIsPublic
     */
    public function setAimIsPublic($aimIsPublic)
    {
        $this->aimIsPublic = $aimIsPublic;
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
     * Set msn
     *
     * @param string $msn
     */
    public function setMsn($msn)
    {
        $this->msn = $msn;
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
     * Set msnIsPublic
     *
     * @param boolean $msnIsPublic
     */
    public function setMsnIsPublic($msnIsPublic)
    {
        $this->msnIsPublic = $msnIsPublic;
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
     * Set icq
     *
     * @param string $icq
     */
    public function setIcq($icq)
    {
        $this->icq = $icq;
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
     * Set icqIsPublic
     *
     * @param boolean $icqIsPublic
     */
    public function setIcqIsPublic($icqIsPublic)
    {
        $this->icqIsPublic = $icqIsPublic;
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
     * Set yahoo
     *
     * @param string $yahoo
     */
    public function setYahoo($yahoo)
    {
        $this->yahoo = $yahoo;
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
     * Set yahooIsPublic
     *
     * @param boolean $yahooIsPublic
     */
    public function setYahooIsPublic($yahooIsPublic)
    {
        $this->yahooIsPublic = $yahooIsPublic;
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
     * Set website
     *
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
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
     * Set location
     *
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
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
     * Set bio
     *
     * @param text $bio
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
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
     * Set signature
     *
     * @param string $signature
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
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
}