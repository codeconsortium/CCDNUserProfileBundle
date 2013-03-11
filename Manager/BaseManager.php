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

namespace CCDNUser\ProfileBundle\Manager;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class BaseManager
{
	
	/**
	 *
	 * @access protected
	 */
    protected $doctrine;

	/**
	 *
	 * @access protected
	 */
    protected $em;

	/**
	 *
	 * @access protected
	 */
    protected $profileRepository;

	/**
	 *
	 * @access protected
	 */	
	protected $profileProvider;
	
	/**
	 *
	 * @access public
	 * @param $doctrine, $repository
	 */
    public function __construct($doctrine, $repository, $profileProvider)
    {
        $this->doctrine = $doctrine;

        $this->em = $doctrine->getEntityManager();

		$this->profileRepository = $repository;
		
		$this->profileProvider = $profileProvider;
    }

	/**
	 *
	 * @access public
	 * @return ProfileRepository
	 */
	public function getProfileRepository()
	{
		return $this->profileRepository;
	}
	
	/**
	 *
	 * @access public
	 * @return ProfileProvider
	 */
	public function getProfileProvider()
	{
		return $this->profileProvider;
	}
	
	/**
	 *
	 * @access public
	 * @param $entity
	 * @return self
	 */
    public function persist($entity)
    {
        $this->em->persist($entity);

        return $this;
    }

	/**
	 *
	 * @access public
	 * @param $entity
	 * @return self
	 */
    public function remove($entity)
    {
        $this->em->remove($entity);

        return $this;
    }

	/**
	 *
	 * @access public
	 * @return self
	 */
    public function flush()
    {
        $this->em->flush();

        return $this;
    }

	/**
	 *
	 * @access public
	 * @param $entity
	 * @return self
	 */
    public function refresh($entity)
    {
        $this->em->refresh($entity);

        return $this;
    }

}
