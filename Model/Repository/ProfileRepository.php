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

namespace CCDNUser\ProfileBundle\Model\Repository;

use CCDNUser\ProfileBundle\Model\Repository\BaseRepository;
use CCDNUser\ProfileBundle\Model\Repository\RepositoryInterface;

/**
 * ProfileRepository
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
class ProfileRepository extends BaseRepository implements RepositoryInterface
{
//    /**
//     *
//     * @access protected
//     * @param  int                                    $profileId
//     * @return \CCDNUser\ProfileBundle\Entity\Profile
//     */
//    protected function getProfileById($profileId)
//    {
//        $profile = $this->em->createQueryBuilder()
//            ->select('p')
//            ->from('CCDNUserProfileBundle:Profile', 'p')
//            ->where('p.id = :id')
//            ->setParameters(
//                array(
//                    ':id' => $profileId,
//                )
//            )
//            ->getQuery()
//            ->getSingleResult();
//
//        return $profile;
//    }
//
//    /**
//     *
//     * @access public
//     * @param  int                                    $profileId
//     * @param  $securityContext
//     * @return \CCDNUser\ProfileBundle\Entity\Profile
//     */
//    public function getProfile($profileId, $securityContext)
//    {
//        if ($profileId == null || $profileId == 0 || ! is_numeric($profileId)) {
//            if (! $securityContext->isGranted('ROLE_USER')) {
//                throw new NotFoundHttpException('User not found!');
//            }
//
//            $user = $securityContext->getToken()->getUser();
//            $profile = $this->connectProfileWithUser($user);
//        } else {
//            $profile = $this->getProfileById($profileId);
//        }
//
//        if (! $profile) {
//            throw new NotFoundHttpException('User not found!');
//        }
//
//        $profile = $this->getProfileProvider()->setup($profile);
//
//        return $profile;
//    }
}
