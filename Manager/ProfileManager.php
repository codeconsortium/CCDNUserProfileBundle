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

use Symfony\Component\Security\Core\User\UserInterface;

use CCDNUser\ProfileBundle\Manager\BaseManagerInterface;
use CCDNUser\ProfileBundle\Manager\BaseManager;

use CCDNUser\ProfileBundle\Entity\Profile;

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
class ProfileManager extends BaseManager implements BaseManagerInterface
{
    /**
     *
     * @access public
     * @param  \CCDNUser\ProfileBundle\Entity\Profile $profile
     * @return self
     */
    public function updateProfile(Profile $profile)
    {
        // update the profile record
        $this
            ->persist($profile)
            ->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param $profile
     * @return self
     */
    public function insert($profile)
    {
        $this->persist($profile);

        return $this;
    }

    /**
     *
     * @access public
     * @param  Symfony\Component\Security\Core\User\UserInterface $user
     * @return \CCDNUser\ProfileBundle\Entity\Profile
     */
    public function connectProfileWithUser(UserInterface $user)
    {
        $profile = $user->getProfile();

        $profile->setUser($user);
        $user->setProfile($profile);

        $this->persist($user, $profile);
        $this->flush();

        $this->refresh($user, $profile);

        return $profile;
    }

    /**
     *
     * @access protected
     * @param $profileId
     * @return \CCDNUser\ProfileBundle\Entity\Profile
     */
    protected function getProfileById($profileId)
    {
        $profile = $this->em->createQueryBuilder()
            ->select('p')
            ->from('CCDNUserProfileBundle:Profile', 'p')
            ->where('p.id = :id')
            ->setParameters(
                array(
                    ':id' => $profileId,
                )
            )
            ->getQuery()
            ->getSingleResult();

        return $profile;
    }

    /**
     *
     * @access public
     * @param $profileId
     * @param $securityContext
     * @return \CCDNUser\ProfileBundle\Entity\Profile
     */
    public function getProfile($profileId, $securityContext)
    {
        if ($profileId == null || $profileId == 0 || ! is_numeric($profileId)) {
            if (! $securityContext->isGranted('ROLE_USER')) {
                throw new NotFoundHttpException('User not found!');
            }

            $user = $securityContext->getToken()->getUser();
            $profile = $this->connectProfileWithUser($user);
        } else {
            $profile = $this->getProfileById($profileId);
        }

        if (! $profile) {
            throw new NotFoundHttpException('User not found!');
        }

        $profile = $this->getProfileProvider()->setup($profile);

        return $profile;
    }
}
