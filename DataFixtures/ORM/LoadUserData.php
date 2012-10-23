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

namespace CCDNUser\ProfileBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use CCDNUser\ProfileBundle\Entity\Profile;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{

	/**
	 *
	 * @access public
	 * @param ObjectManager $manager
	 */
    public function load(ObjectManager $manager)
    {
		$profileAdmin = new Profile();
		
		$profileAdmin->setUser($manager->merge($this->getReference('user-admin')));
		$profileAdmin->setLocation('London, United Kingdom');
		$profileAdmin->setBio('');
		$profileAdmin->setSignature('');
		
		$profileTest = new Profile();
		
		$profileTest->setUser($manager->merge($this->getReference('user-test')));
		$profileTest->setLocation('London, United Kingdom');
		$profileTest->setBio('');
		$profileTest->setSignature('');
		
		$manager->persist($profileAdmin, $profileTest);
		$manager->flush();
    }

	/**
	 *
	 * @access public
	 * @return int
	 */
	public function getOrder()
	{
		return 2;
	}
	
}
