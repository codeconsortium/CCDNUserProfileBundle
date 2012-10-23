<?php
namespace CCDNUser\ProfileBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use CCDNUser\UserBundle\Entity\User;
use CCDNUser\ProfileBundle\Entity\Profile;

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