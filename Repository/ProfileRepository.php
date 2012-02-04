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

namespace CCDNUser\ProfileBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProfileRepository
 *
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class ProfileRepository extends EntityRepository
{


	/**
	 *
	 * @access public
	 * @param int $user_id
	 */
	public function findOneByIdJoinedToUser($user_id)
	{	
		$query = $this->getEntityManager()
			->createQuery('
				SELECT u, p	FROM CCDNUserUserBundle:User u
				LEFT JOIN u.profile p
				WHERE u.id = :id')
			->setParameter('id', $user_id);
					
		try {
	        return $query->getSingleResult();
	    } catch (\Doctrine\ORM\NoResultException $e) {
	        return null;
	    }
	}

}