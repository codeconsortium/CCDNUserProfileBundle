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

namespace CCDNUser\ProfileBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use CCDNUser\UserBundle\Entity\User;
use CCDNUser\ProfileBundle\Entity\Profile;

/**
 *
 * @category CCDNUser
 * @package  ProfileBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 1.0
 * @link     https://github.com/codeconsortium/CCDNUserProfileBundle
 *
 */
class ProfileRepositoryFunctionalTest extends WebTestCase
{
    /**
	 *
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

	/**
	 *
	 * @access public
	 */
    public function setUp()
    {
        $kernel = static::createKernel();
        $kernel->boot();
		
        $this->em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

	/**
	 *
	 * @access private
	 */
	private function addUser()
	{
		// Create a User
		$user = new User();

		$user->setUsername(rand());
		$user->setPassword('foo');
		$user->setEmail(rand());

		$this->em->persist($user);
		$this->em->flush();
		$this->em->refresh($user);
		
		return $user;
	}

	/**
	 *
	 * @access private
	 */
	private function addProfile($user)
	{
		// Create a User
		$profile = new Profile();

		$profile->setUser($user);

		$this->em->persist($profile);
		$this->em->flush();
		$this->em->refresh($profile);
		
		return $profile;
	}

	/**
	 *
	 * @access public
	 */
    public function testFindOneByIdJoinedToUser()
    {
		$user 		= $this->addUser();
		$profile	= $this->addProfile($user);
		
		$userId 	= $user->getId();
		
		$user->setProfile($profile);
		
		$this->em->persist($user);
		$this->em->flush();
		$this->em->refresh($user);
		
        $result = $this->em
            ->getRepository('CCDNUserProfileBundle:Profile')
            ->findOneByIdJoinedToUser($userId);
	
		$this->assertTrue(($user->getId() && $profile->getId() ? true : false));
		$this->assertTrue(($user->getProfile()->getId() == $profile->getId() ? true : false));
		$this->assertTrue(($user->getId() == $profile->getUser()->getId() ? true : false));
		
        $this->assertTrue(((is_object($result) && ($result instanceof User)) ? true : false));
    }
}