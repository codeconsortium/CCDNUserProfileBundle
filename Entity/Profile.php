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
     * @ORM\JoinColumn(name="fk_user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $user;

    /**
     * @ORM\Column(type="boolean", name="avatar_is_remote", nullable=true)
     */
    protected $avatarIsRemote = false;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $avatar;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $aim;

    /**
     * @ORM\Column(type="boolean", name="aim_is_public", nullable=true)
     */
    protected $aimIsPublic = false;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $msn;

    /**
     * @ORM\Column(type="boolean", name="msn_is_public", nullable=true)
     */
    protected $msnIsPublic = false;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $icq;

    /**
     * @ORM\Column(type="boolean", name="icq_is_public", nullable=true)
     */
    protected $icqIsPublic = false;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $yahoo;

    /**
     * @ORM\Column(type="boolean", name="yahoo_is_public", nullable=true)
     */
    protected $yahooIsPublic = false;

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

    /**
     * Set user
     *
     * @param CCDNUser\UserBundle\Entity\User $user
     */
    public function setUser(\CCDNUser\UserBundle\Entity\User $user = null)
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
}
