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

use CCDNUser\ProfileBundle\Entity\Model\ProfileModel as AbstractProfile;

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
     * @var string $birthDate
     */
    protected $birthDate;

    /**
     *
     * @access protected
     * @var string $realName
     */
    protected $realName;

    /**
     *
     * @access protected
     * @var string $locationCount
     */
    protected $locationCountry;

    /**
     *
     * @access protected
     * @var string $locationCity
     */
    protected $locationCity;

    /**
     *
     * @access protected
     * @var string $company
     */
    protected $company;

    /**
     *
     * @access protected
     * @var string $position
     */
    protected $position;

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
     * @var Boolean $avatarRemote
     */
    protected $avatarRemote = false;

    /**
     *
     * @access protected
     * @var string $avatar
     */
    protected $avatar;

    /**
     *
     * @access protected
     * @var string $website
     */
    protected $website;

    /**
     *
     * @access protected
     * @var string $blogUrl
     */
    protected $blogUrl;

    /**
     *
     * @access protected
     * @var string $blogFeedUrl
     */
    protected $blogFeedUrl;

    /**
     *
     * @access protected
     * @var string $aim
     */
    protected $aim;

    /**
     *
     * @access protected
     * @var Boolean $aimPublic
     */
    protected $aimPublic = false;

    /**
     *
     * @access protected
     * @var string $msn
     */
    protected $msn;

    /**
     *
     * @access protected
     * @var Boolean $msnPublic
     */
    protected $msnPublic = false;

    /**
     *
     * @access protected
     * @var string $icq
     */
    protected $icq;

    /**
     *
     * @access protected
     * @var Boolean $icqPublic
     */
    protected $icqPublic = false;

    /**
     *
     * @access protected
     * @var string $yahoo
     */
    protected $yahoo;

    /**
     *
     * @access protected
     * @var Boolean $yahooPublic
     */
    protected $yahooPublic = false;

    /**
     *
     * @access public
     */
    public function __construct()
    {
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
     * Get birthDate
     *
     * @return \Date
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set birthDate
     *
     * @param  \Date  $birthDate
     * @return Profile
     */
    public function setBirthDate(\Datetime $birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get realName
     *
     * @return string
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * Set realName
     *
     * @param  string  $realName
     * @return Profile
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;

        return $this;
    }

    /**
     * Get locationCountry
     *
     * @return string
     */
    public function getLocationCountry()
    {
        return $this->locationCountry;
    }

    /**
     * Set locationCountry
     *
     * @param  string  $locationCountry
     * @return Profile
     */
    public function setLocationCountry($locationCountry)
    {
        $this->locationCountry = $locationCountry;

        return $this;
    }

    /**
     * Get locationCity
     *
     * @return string
     */
    public function getLocationCity()
    {
        return $this->locationCity;
    }

    /**
     * Set locationCity
     *
     * @param  string  $locationCity
     * @return Profile
     */
    public function setLocationCity($locationCity)
    {
        $this->locationCity = $locationCity;

        return $this;
    }

    /**
     * Get Company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set company
     *
     * @param  string  $company
     * @return Profile
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set position
     *
     * @param  string  $position
     * @return Profile
     */
    public function setPosition($position)
    {
        $this->position = $position;

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

    /**
     * Get avatarRemote
     *
     * @return boolean
     */
    public function isAvatarRemote()
    {
        return $this->avatarRemote;
    }

    /**
     * Set avatarRemote
     *
     * @param  boolean $avatarRemote
     * @return Profile
     */
    public function setAvatarRemote($avatarRemote)
    {
        $this->avatarRemote = $avatarRemote;

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
     * Has website
     *
     * @return bool
     */
    public function hasWebsite()
    {
		if ($this->getWebsite()) {
			return true;
		}
		
		return false;
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
     * Has blogUrl
     *
     * @return bool
     */
    public function hasBlogUrl()
    {
		if ($this->getBlogUrl()) {
			return true;
		}
		
		return false;
    }

    /**
     * Get blogUrl
     *
     * @return string
     */
    public function getBlogUrl()
    {
        return $this->blogUrl;
    }

    /**
     * Set blogUrl
     *
     * @param  string  $blogUrl
     * @return Profile
     */
    public function setBlogUrl($blogUrl)
    {
        $this->blogUrl = $blogUrl;

        return $this;
    }

    /**
     * Has blogFeedUrl
     *
     * @return bool
     */
    public function hasBlogFeedUrl()
    {
		if ($this->getBlogFeedUrl()) {
			return true;
		}
		
		return false;
    }

    /**
     * Get blogFeedUrl
     *
     * @return string
     */
    public function getBlogFeedUrl()
    {
        return $this->blogFeedUrl;
    }

    /**
     * Set blogFeedUrl
     *
     * @param  string  $blogFeedUrl
     * @return Profile
     */
    public function setBlogFeedUrl($blogFeedUrl)
    {
        $this->blogFeedUrl = $blogFeedUrl;

        return $this;
    }










	/**
	 * Has aim
	 * 
	 * @return bool
	 */
	public function hasAim()
	{
		if ($this->getAim()) {
			return true;
		}
		
		return false;
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
     * Is aimPublic
     *
     * @return boolean
     */
    public function isAimPublic()
    {
        return $this->aimPublic;
    }

    /**
     * Set aimPublic
     *
     * @param  boolean $aimPublic
     * @return Profile
     */
    public function setAimPublic($aimPublic)
    {
        $this->aimPublic = $aimPublic;

        return $this;
    }

	/**
	 * Has msn
	 * 
	 * @return bool
	 */
	public function hasMsn()
	{
		if ($this->getMsn()) {
			return true;
		}
		
		return false;
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
     * Is msnPublic
     *
     * @return boolean
     */
    public function isMsnPublic()
    {
        return $this->msnPublic;
    }

    /**
     * Set msnPublic
     *
     * @param  boolean $msnPublic
     * @return Profile
     */
    public function setMsnPublic($msnPublic)
    {
        $this->msnPublic = $msnPublic;

        return $this;
    }

	/**
	 * Has icq
	 * 
	 * @return bool
	 */
	public function hasIcq()
	{
		if ($this->getIcq()) {
			return true;
		}
		
		return false;
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
     * Is icqPublic
     *
     * @return boolean
     */
    public function isIcqPublic()
    {
        return $this->icqPublic;
    }

    /**
     * Set icqPublic
     *
     * @param  boolean $icqPublic
     * @return Profile
     */
    public function setIcqPublic($icqPublic)
    {
        $this->icqPublic = $icqPublic;

        return $this;
    }

	/**
	 * Has yahoo
	 * 
	 * @return bool
	 */
	public function hasYahoo()
	{
		if ($this->getYahoo()) {
			return true;
		}
		
		return false;
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
     * Is yahooPublic
     *
     * @return boolean
     */
    public function isYahooPublic()
    {
        return $this->yahooPublic;
    }

    /**
     * Set yahooPublic
     *
     * @param  boolean $yahooPublic
     * @return Profile
     */
    public function setYahooPublic($yahooPublic)
    {
        $this->yahooPublic = $yahooPublic;

        return $this;
    }
}
