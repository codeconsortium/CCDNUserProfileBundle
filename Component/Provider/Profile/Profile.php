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

namespace CCDNUser\ProfileBundle\Component\Provider\Profile;

use Symfony\Component\Security\Core\User\UserInterface;
use CCDNComponent\CommonBundle\Component\Provider\Profile\ProfileInterface;

class Profile implements ProfileInterface
{
    /** @var \Symfony\Component\Security\Core\User\UserInterface $user */
    protected $user;

    /** @var string $profilePath */
    protected $profilePath;

    /** @var string $username */
    protected $username;

    /** @var string $avatar */
    protected $avatar;

    /** @var string $avatarFallback */
    protected $avatarFallback;

    /** @var string $signature */
    protected $signature;

    /** @var array $roleBadges */
    protected $roleBadges;

    static $badgeColours = array(
        'grey' => 'label',
        'green' => 'label-success',
        'orange' => 'label-warning',
        'red' => 'label-important',
        'blue' => 'label-info',
        'black' => 'label-inverse',
    );

	protected $router;

    public function __construct()
    {
        $this->roleBadges = array();
    }

    /**
     * @return \Symfony\Component\Security\Core\User\UserInterface $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return Profile $this
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

	public function getRouter()
	{
		return $this->router;
	}
	
	public function setRouter($router)
	{
		$this->router = $router;
		
		return $this;
	}
	
    /**
     * @return string
     */
    public function getProfilePath()
    {
		if (null !== $this->user) {
			if (null !== $this->user->getId()) {
				$url = $this->router->generate('ccdn_user_profile_show_by_id', array('profileId' => $this->getId()));
	        
				return '<a href="' . $url . '"><bdi>' . ucwords($this->username) . '</bdi></a>';			
			} else {
				return '<bdi>' . ucwords($this->username) . '</bdi>';
			}
		} else {
			return '<bdi>' . ucwords($this->username) . '</bdi>';
		}
    }

    /**
     * @param $profilePath
     * @return Profile $this
     */
    public function setProfilePath($profilePath)
    {
        $this->profilePath = $profilePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
		if (null == $this->username) {
			if (null == $this->user) {
				$this->username = 'Guest';
			} else {
				$this->username = $this->user->getUsername();
			}
		}
		
        return ucwords($this->username);
    }
	
    /**
     * @return string
     */
    public function getUsernameBDI()
    {
		if (null == $this->username) {
			if (null == $this->user) {
				$this->username = 'Guest';
			} else {
				$this->username = $this->user->getUsername();
			}
		}
		
        return '<bdi>' . ucwords($this->username) . '</bdi>';
    }

    /**
     * @param string $username
     * @return Profile $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
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

        return '<img ' . $class . ' width="' . $scaleX . '" height="' . $scaleY . '" src="' . $this->getAvatarUrl() . '" alt="avatar" />';
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatar ?: $this->avatarFallback;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return Profile $this
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvatarFallback()
    {
        return $this->avatarFallback;
    }

    /**
     * @param string $avatar
     * @return Profile $this
     */
    public function setAvatarFallback($avatar)
    {
        $this->avatarFallback = $avatar;

        return $this;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     * @return Profile $this
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoleBadges()
    {
        return $this->roleBadges;
    }

    /**
     * @param array $badges
     * @return Profile $this
     */
    public function setRoleBadges(array $badges = null)
    {
        $this->roleBadges = $badges;

        return $this;
    }

    /**
     * @param array $badges
     * @return Profile $this
     */
    public function addRoleBadges(array $badges)
    {
        foreach ($badges as $badge) {
            $this->roleBadges[] = $badge;
        }

        return $this;
    }

    /**
     * @return Profile $this
     */
    public function autoSetRoleBadge()
    {
        $badges = array('grey', 'Anonymous');

        if (null !== $this->user) {
			if ($this->user->isLocked()) {
				$badges = array('black', 'Banned');
			} else {
	            if ($this->user->hasRole('ROLE_USER')) {
	                $badges = array('blue', 'Member');
	            }

	            if ($this->user->hasRole('ROLE_MODERATOR')) {
	                $badges = array('red', 'Staff');
	            }

	            if ($this->user->hasRole('ROLE_ADMIN')) {
	                $badges = array('red', 'Staff');
	            }

	            if ($this->user->hasRole('ROLE_SUPER_ADMIN')) {
	                $badges = array('red', 'Staff');
	            }
			}
        }

        $this->roleBadges = array($badges);

        return $this;
    }

    /**
     * @return string
     */
    public function renderRoleBadges()
    {
        $html = '';

        if ( ! is_array($this->roleBadges) && count($this->roleBadges) < 1) {
            return '';
        }

        foreach ($this->roleBadges as $badge) {
            if (! is_array($badge)) {
                continue;
            }

            $colour = (array_key_exists($badge[0], self::$badgeColours) ? self::$badgeColours[$badge[0]] : 'label');
            $message = $badge[1];

            $html .= '<span class="label ' . $colour . '">' . $message . '</span>';
        }

        return $html;
    }
	
	/** @var Array $contactPoints */
	protected $contactPoints = array(
		
	);
	
	public function hasContactPoint($contactPoint)
	{
		if (array_key_exists($contactPoint, $this->contactPoints)) {
			$contact = $this->contactPoints[$contactPoint]['contact'];
			if ($this->$contact()) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	 *
	 * @access public
	 * @param string $contactPoint
	 * @return Boolean
	 */
	public function isContactPointPublic($contactPoint)
	{
		if (array_key_exists($contactPoint, $this->contactPoints)) {
			$isPublic = $this->contactPoints[$contactPoint]['is_public'];
			if ($this->$isPublic()) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	 *
	 * @access public
	 * @param string $contactPoint
	 * @return string
	 */
	public function contactPoint($contactPoint)
	{
		if (array_key_exists($contactPoint, $this->contactPoints)) {
			if (! array_key_exists('is_public', $this->contactPoints[$contactPoint])
			||  ! array_key_exists('contact', $this->contactPoints[$contactPoint])) {
				return '';
			}
			
			$contact = $this->contactPoints[$contactPoint]['contact'];
			$isPublic = $this->contactPoints[$contactPoint]['is_public'];
			
			if ($this->$isPublic()) {
				return $this->$contact();
			}
		}

		return '';
	}
}
