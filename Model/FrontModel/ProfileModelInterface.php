<?php

namespace CCDNUser\ProfileBundle\Model\FrontModel;

use CCDNUser\ProfileBundle\Model\Component\Manager\ProfileManagerInterface;
use CCDNUser\ProfileBundle\Model\Component\Repository\ProfileRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use CCDNUser\ProfileBundle\Entity\Profile;

interface ProfileModelInterface extends ModelInterface
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
    );

    /**
     *
     * @access public
     * @return Profile
     */
    public function createProfile();

    /**
     *
     * @access public
     * @param  Profile $profile
     */
    public function saveProfile(Profile $profile);

    /**
     *
     * @access public
     * @param  Profile $profile
     */
    public function updateProfile(Profile $profile);
}
