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

namespace CCDNUser\ProfileBundle\features\bootstrap;

use Behat\Behat\Context\BehatContext;
use Behat\Gherkin\Node\TableNode;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Doctrine\ORM\EntityManager;

use CCDNUser\ProfileBundle\Tests\Functional\src\Entity\User;
use CCDNUser\ProfileBundle\Entity\Profile;

/**
 *
 * Features context.
 *
 * @category CCDNUser
 * @package  ProfileBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserProfileBundle
 *
 */
class DataContext extends BehatContext implements KernelAwareInterface
{
    /**
     *
     * Kernel.
     *
     * @var KernelInterface
     */
    protected $kernel;

    /**
     *
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     *
     * Get entity manager.
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }

    /**
     *
     * Returns Container instance.
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->kernel->getContainer();
    }

    /**
     *
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    protected function getService($id)
    {
        return $this->getContainer()->get($id);
    }

    protected $users = array();

    /**
     *
     * @Given /^there are following users defined:$/
     */
    public function thereAreFollowingUsersDefined(TableNode $table)
    {
        foreach ($table->getHash() as $data) {
            $username = isset($data['name']) ? $data['name'] : sha1(uniqid(mt_rand(), true));

            $this->users[$username] = $this->thereIsUser(
                $username,
                isset($data['email']) ? $data['email'] : sha1(uniqid(mt_rand(), true)),
                isset($data['password']) ? $data['password'] : 'password',
                isset($data['role']) ? $data['role'] : 'ROLE_USER',
                isset($data['enabled']) ? $data['enabled'] : true
            );
        }

        $this->getEntityManager()->flush();
    }

    public function thereIsUser($username, $email, $password, $role = 'ROLE_USER', $enabled = true)
    {
        $user = new User();

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setEnabled($enabled);
        $user->setPlainPassword($password);

        if (null !== $role) {
            $user->addRole($role);
        }

        $this->getEntityManager()->persist($user);

        return $user;
    }

    protected $profiles = array();

    /**
     *
     * @Given /^the following profiles have been filled in:$/
     */
    public function theFollowingProfileHaveBeenFilledIn(TableNode $table)
    {
        $em = $this->getEntityManager();
        $profileDefaults = array(
            'country' => null,
            'city' => null,
            'real_name' => null,
            'birthday' => null,
            'company' => null,
            'position' => null,
            'bio' => null,
            'signature' => null,
            'msn' => null,
            'aim' => null,
            'yahoo' => null,
            'icq' => true,
        );

        foreach ($table->getHash() as $data) {
            $username = $data['user'];
            $data += $profileDefaults;
            $user = $em->getRepository('CCDNUser\\ProfileBundle\\Tests\\Functional\\src\\Entity\\User')
                ->findOneByUsername($username);

            /** @var Profile $userProfile */
            $userProfile = $user->getProfile();
            $userProfile->setLocationCountry($data['country']);
            $userProfile->setLocationCity($data['city']);
            $userProfile->setRealName($data['real_name']);
            if (!is_null($data['birthday'])) {
                $userProfile->setBirthDate(new \DateTime($data['birthday']));
            }
            $userProfile->setCompany($data['company']);
            $userProfile->setPosition($data['position']);
            $userProfile->setBio($data['bio']);
            $userProfile->setSignature($data['signature']);
            $userProfile->setMsn($data['msn']);
            $userProfile->setMsnPublic(true);
            $userProfile->setAim($data['aim']);
            $userProfile->setAimPublic(true);
            $userProfile->setYahoo($data['yahoo']);
            $userProfile->setYahooPublic(true);
            $userProfile->setIcq($data['icq']);
            $userProfile->setIcqPublic(true);

            $this->profiles[$username] = $user;
        }

        $this->getEntityManager()->flush();
    }
}
