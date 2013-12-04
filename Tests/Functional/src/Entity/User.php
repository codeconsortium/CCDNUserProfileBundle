<?php

namespace CCDNUser\ProfileBundle\Tests\Functional\src\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use CCDNUser\ProfileBundle\Entity\Profile;

class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
		
        // your own logic
		$this->registeredDate = new \Datetime('now');
    }

	protected $profile;

    /**
     *
     * @access protected
     * @var \DateTime $registeredDate
     */
    protected $registeredDate;

	public function setProfile(Profile $profile)
	{
		$this->profile = $profile;
		
		return $this;
	}

	public function getProfile()
	{
		return $this->profile;
	}

    /**
     * Get registeredDate
     *
     * @return \Datetime
     */
    public function getRegisteredDate()
    {
        return $this->registeredDate;
    }

    /**
     * Set registeredDate
     *
     * @param  \Datetime $registeredDate
     * @return User
     */
    public function setRegisteredDate(\Datetime $registeredDate)
    {
        $this->registeredDate = $registeredDate;

        return $this;
    }
}