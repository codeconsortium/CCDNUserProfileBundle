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

namespace CCDNUser\ProfileBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

use CCDNUser\ProfileBundle\Tests\Functional\src\Entity\User;
use CCDNUser\ProfileBundle\Entity\Profile;

class TestBase extends WebTestCase
{
    /**
	 *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

	/**
	 *
	 * @var $container
	 */
	private $container;

	/**
	 *
	 * @access public
	 */
    public function setUp()
    {
        $kernel = static::createKernel();

        $kernel->boot();
		
		$this->container = $kernel->getContainer();

        $this->em = $this->container->get('doctrine.orm.entity_manager');
		
		$this->purge();
    }

	/*
     *
     * Close doctrine connections to avoid having a 'too many connections'
     * message when running many tests
     */
	public function tearDown(){
		$this->container->get('doctrine')->getConnection()->close();
	
		parent::tearDown();
	}

    protected function purge()
    {
        $purger = new ORMPurger($this->em);
        $executor = new ORMExecutor($this->em, $purger);
        $executor->purge();
	}

	protected function addNewUser($username, $email, $password)
	{
		$user = new User();
		
		$user->setUsername($username);
		$user->setEmail($email);
		$user->setPlainPassword($password);
		
		$this->em->persist($user);
		
		return $user;
	}

	protected function addFixturesForUsers()
	{
		$userNames = array('admin', 'tom', 'dick', 'harry');
		$users = array();
		
		foreach ($userNames as $username) {
			$users[$username] = $this->addNewUser($username, $username . '@foobar.com', 'password');
		}
	
		$this->em->flush();
	
		return $users;
	}

    /**
     *
     * @var \CCDNUser\ProfileBundle\Model\FrontModel\UserModel $userModel
     */
    private $userModel;

    /**
     *
     * @var \CCDNUser\ProfileBundle\Model\FrontModel\ProfileModel $profileModel
     */
    private $profileModel;

    /**
     *
     * @access protected
     * @return \CCDNUser\ProfileBundle\Model\FrontModel\UserModel
     */
    protected function getUserModel()
    {
        if (null == $this->userModel) {
            $this->userModel = $this->container->get('ccdn_user_profile.model.user');
        }

        return $this->userModel;
    }

    /**
     *
     * @access protected
     * @return \CCDNUser\ProfileBundle\Model\FrontModel\ProfileModel
     */
    protected function getProfileModel()
    {
        if (null == $this->profileModel) {
            $this->profileModel = $this->container->get('ccdn_user_profile.model.profile');
        }

        return $this->profileModel;
    }
}
