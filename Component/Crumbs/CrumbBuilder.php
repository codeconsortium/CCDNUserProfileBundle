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

namespace CCDNUser\ProfileBundle\Component\Crumbs;

use CCDNUser\ProfileBundle\Entity\ProfileUserInterface;

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
class CrumbBuilder extends BaseCrumbBuilder
{
    /**
     *
     * @access public
     * @return \CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addMemberIndex()
    {
        return $this->createCrumbTrail()
            ->add('crumbs.member.index', 'ccdn_user_profile_member_index')
        ;
    }

    /**
     *
     * @access public
     * @param  ProfileUserInterface         $user
     * @return \CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addProfileOverviewShow(ProfileUserInterface $user)
    {
        return $this->addMemberIndex()
            ->add(
                array(
                    'label' => 'crumbs.profile.overview.show',
                    'params' => array(
                        '%username%' => $user->getUsername()
                    )
                ),
                array(
                    'route' => 'ccdn_user_profile_show_by_id',
                    'params' => array(
                        'userId' => $user->getId()
                    )
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  ProfileUserInterface         $user
     * @return \CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addProfileBioShow(ProfileUserInterface $user)
    {
        return $this->addMemberIndex()
            ->add(
                array(
                    'label' => 'crumbs.profile.bio.show',
                    'params' => array(
                        '%username%' => $user->getUsername()
                    )
                ),
                array(
                    'route' => 'ccdn_user_profile_show_bio_by_id',
                    'params' => array(
                        'userId' => $user->getId()
                    )
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  ProfileUserInterface         $user
     * @return \CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addProfilePersonalEdit(ProfileUserInterface $user)
    {
        return $this->addProfileOverviewShow($user)
            ->add('crumbs.profile.personal.edit',
                array(
                    'route' => 'ccdn_user_profile_personal_edit',
                    'params' => array(
                        'userId' => $user->getId()
                    )
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  ProfileUserInterface         $user
     * @return \CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addProfileInfoEdit(ProfileUserInterface $user)
    {
        return $this->addProfileOverviewShow($user)
            ->add('crumbs.profile.info.edit',
                array(
                    'route' => 'ccdn_user_profile_info_edit',
                    'params' => array(
                        'userId' => $user->getId()
                    )
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  ProfileUserInterface         $user
     * @return \CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addProfileContactEdit(ProfileUserInterface $user)
    {
        return $this->addProfileOverviewShow($user)
            ->add('crumbs.profile.contact.edit',
                array(
                    'route' => 'ccdn_user_profile_contact_edit',
                    'params' => array(
                        'userId' => $user->getId()
                    )
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  ProfileUserInterface         $user
     * @return \CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addProfileAvatarEdit(ProfileUserInterface $user)
    {
        return $this->addProfileOverviewShow($user)
            ->add('crumbs.profile.avatar.edit',
                array(
                    'route' => 'ccdn_user_profile_avatar_edit',
                    'params' => array(
                        'userId' => $user->getId()
                    )
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  ProfileUserInterface         $user
     * @return \CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addProfileBioEdit(ProfileUserInterface $user)
    {
        return $this->addProfileOverviewShow($user)
            ->add('crumbs.profile.bio.edit',
                array(
                    'route' => 'ccdn_user_profile_bio_edit',
                    'params' => array(
                        'userId' => $user->getId()
                    )
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  ProfileUserInterface         $user
     * @return \CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addProfileSignatureEdit(ProfileUserInterface $user)
    {
        return $this->addProfileOverviewShow($user)
            ->add('crumbs.profile.signature.edit',
                array(
                    'route' => 'ccdn_user_profile_signature_edit',
                    'params' => array(
                        'userId' => $user->getId()
                    )
                )
            )
        ;
    }
}
