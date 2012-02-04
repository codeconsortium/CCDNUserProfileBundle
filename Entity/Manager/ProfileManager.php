<?php

namespace CCDNUser\ProfileBundle\Entity\Manager;

use CCDNCommon\CommonBundle\Entity\Manager\EntityManagerInterface;
use CCDNCommon\CommonBundle\Entity\Manager\BaseManager;

/**
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class ProfileManager extends BaseManager implements EntityManagerInterface
{
	
	
	/**
	 *
	 * @access public
	 * @param $profile
	 * @return $this
	 */	
	public function update($profile)
	{
		// update the profile record
		$this->persist($profile);
		
		return $this;
	}
	
	
	/**
	 *
	 * @access public
	 * @param $profile
	 * @return $this
	 */
	public function insert($profile)
	{
		$this->persist($profile);
		
		return $this;
	}
}