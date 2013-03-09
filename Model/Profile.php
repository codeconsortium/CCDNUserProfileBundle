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

namespace CCDNUser\ProfileBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Security\Core\User\UserInterface;


abstract class Profile
{
    /** @var Symfony\Component\Security\Core\User\UserInterface $user */
    protected $user;
	
	/**
	 *
	 * @access public
	 */
    public function __construct()
    {
        // your own logic
    }

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
	
    /**
     * Set user
     *
     * @param UserInterface $user
	 * @return Profile
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;
		
		return $this;
    }
}
