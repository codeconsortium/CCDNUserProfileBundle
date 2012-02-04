<?php

/*
 * This file is part of the CCDN ProfileBundle
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

use CCDNUser\UserBundle\Entity\User;

/**
 * @ORM\Entity(repositoryClass="CCDNUser\ProfileBundle\Repository\ProfileRepository")
 * @ORM\Table(name="CC_User_Profile")
 */
class Profile
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;

	/**
	 * @ORM\OneToOne(targetEntity="CCDNUser\UserBundle\Entity\User")
	 */
	protected $user;
	
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $avatar_is_remote = false;
	
	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $avatar;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $aim;
	
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $aim_is_public = false;
	
	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $msn;
	
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $msn_is_public = false;
	
	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $icq;
	
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $icq_is_public = false;
	
	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $yahoo;
	
	/**
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $yahoo_is_public = false;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $website;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $location;
	
	/**
     * @ORM\Column(type="text", nullable=true)
	 */
	protected $bio;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */	
	protected $signature;
 


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
     * Set avatar_is_remote
     *
     * @param boolean $avatarIsRemote
     */
    public function setAvatarIsRemote($avatarIsRemote)
    {
        $this->avatar_is_remote = $avatarIsRemote;
    }

    /**
     * Get avatar_is_remote
     *
     * @return boolean 
     */
    public function getAvatarIsRemote()
    {
        return $this->avatar_is_remote;
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
     * Set aim_is_public
     *
     * @param boolean $aimIsPublic
     */
    public function setAimIsPublic($aimIsPublic)
    {
        $this->aim_is_public = $aimIsPublic;
    }

    /**
     * Get aim_is_public
     *
     * @return boolean 
     */
    public function getAimIsPublic()
    {
        return $this->aim_is_public;
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
     * Set msn_is_public
     *
     * @param boolean $msnIsPublic
     */
    public function setMsnIsPublic($msnIsPublic)
    {
        $this->msn_is_public = $msnIsPublic;
    }

    /**
     * Get msn_is_public
     *
     * @return boolean 
     */
    public function getMsnIsPublic()
    {
        return $this->msn_is_public;
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
     * Set icq_is_public
     *
     * @param boolean $icqIsPublic
     */
    public function setIcqIsPublic($icqIsPublic)
    {
        $this->icq_is_public = $icqIsPublic;
    }

    /**
     * Get icq_is_public
     *
     * @return boolean 
     */
    public function getIcqIsPublic()
    {
        return $this->icq_is_public;
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
     * Set yahoo_is_public
     *
     * @param boolean $yahooIsPublic
     */
    public function setYahooIsPublic($yahooIsPublic)
    {
        $this->yahoo_is_public = $yahooIsPublic;
    }

    /**
     * Get yahoo_is_public
     *
     * @return boolean 
     */
    public function getYahooIsPublic()
    {
        return $this->yahoo_is_public;
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
		if (!empty($this->website))
		{
			if (substr($this->website, 0, 7) != 'http://')
			{
				$this->website = 'http://' . $this->website;
			}
		}
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
     * Set user
     *
     * @param CCDNUser\UserBundle\Entity\User $user
     */
    public function setUser(\CCDNUser\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return CCDNUser\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
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