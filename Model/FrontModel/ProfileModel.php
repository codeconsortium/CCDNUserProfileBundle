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

namespace CCDNUser\ProfileBundle\Model\FrontModel;

use CCDNUser\ProfileBundle\Entity\Profile;
use CCDNUser\ProfileBundle\Model\Component\Manager\ProfileManagerInterface;
use CCDNUser\ProfileBundle\Model\Component\Repository\ProfileRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
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
class ProfileModel extends BaseModel implements ProfileModelInterface
{
    /**
     *
     * @access public
     * @param EventDispatcherInterface $dispatcher
     * @param ProfileRepositoryInterface $repository
     * @param ProfileManagerInterface $manager
     */
    public function __construct(
        EventDispatcherInterface $dispatcher,
        ProfileRepositoryInterface $repository,
        ProfileManagerInterface $manager
    ) {
        parent::__construct($dispatcher, $repository, $manager);
    }

    /**
     * @return ProfileManagerInterface
     */
    public function getManager()
    {
        return parent::getManager();
    }

    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Entity\Profile
     */
    public function createProfile()
    {
        return $this->getManager()->createProfile();
    }

    /**
     *
     * @access public
     * @param  \CCDNUser\ProfileBundle\Entity\Profile $profile
     * @return $this
     */
    public function saveProfile(Profile $profile)
    {
        $this->getManager()->saveProfile($profile);

        return $this;
    }

    /**
     *
     * @access public
     * @param \CCDNUser\ProfileBundle\Entity\Profile $profile
     */
    public function updateProfile(Profile $profile)
    {
        return $this->getManager()->updateProfile($profile);
    }
}
