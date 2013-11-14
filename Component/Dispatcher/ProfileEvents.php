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

namespace CCDNUser\ProfileBundle\Component\Dispatcher;

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
final class ProfileEvents
{
    /**
     *
     * The USER_PROFILE_UPDATE_AVATAR_INITIALISE event occurs when the profile update process is initalised.
     *
     * This event allows you to modify the default values of the profile entity object before binding the form.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_AVATAR_INITIALISE = 'ccdn_profile.user.profile.update.avatar.initialise';

    /**
     *
     * The USER_PROFILE_UPDATE_AVATAR_SUCCESS event occurs when the profile update process is successful before persisting.
     *
     * This event allows you to modify the values of the profile entity object after form submission before persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_AVATAR_SUCCESS = 'ccdn_profile.user.profile.update.avatar.success';

    /**
     *
     * The USER_PROFILE_UPDATE_AVATAR_COMPLETE event occurs when the profile update process is completed successfully after persisting.
     *
     * This event allows you to modify the values of the profile entity after persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_AVATAR_COMPLETE = 'ccdn_profile.user.profile.update.avatar.complete';

    /**
     *
     * The USER_PROFILE_UPDATE_AVATAR_RESPONSE event occurs when the profile update process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileResponseEvent instance.
     */
    const USER_PROFILE_UPDATE_AVATAR_RESPONSE = 'ccdn_profile.user.profile.update.avatar.response';

    /**
     *
     * The USER_PROFILE_UPDATE_BIO_INITIALISE event occurs when the profile update process is initalised.
     *
     * This event allows you to modify the default values of the profile entity object before binding the form.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_BIO_INITIALISE = 'ccdn_profile.user.profile.update.bio.initialise';

    /**
     *
     * The USER_PROFILE_UPDATE_BIO_SUCCESS event occurs when the profile update process is successful before persisting.
     *
     * This event allows you to modify the values of the profile entity object after form submission before persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_BIO_SUCCESS = 'ccdn_profile.user.profile.update.bio.success';

    /**
     *
     * The USER_PROFILE_UPDATE_BIO_COMPLETE event occurs when the profile update process is completed successfully after persisting.
     *
     * This event allows you to modify the values of the profile entity after persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_BIO_COMPLETE = 'ccdn_profile.user.profile.update.bio.complete';

    /**
     *
     * The USER_PROFILE_UPDATE_BIO_RESPONSE event occurs when the profile update process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileResponseEvent instance.
     */
    const USER_PROFILE_UPDATE_BIO_RESPONSE = 'ccdn_profile.user.profile.update.bio.response';

    /**
     *
     * The USER_PROFILE_UPDATE_CONTACT_INITIALISE event occurs when the profile update process is initalised.
     *
     * This event allows you to modify the default values of the profile entity object before binding the form.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_CONTACT_INITIALISE = 'ccdn_profile.user.profile.update.contact.initialise';

    /**
     *
     * The USER_PROFILE_UPDATE_CONTACT_SUCCESS event occurs when the profile update process is successful before persisting.
     *
     * This event allows you to modify the values of the profile entity object after form submission before persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_CONTACT_SUCCESS = 'ccdn_profile.user.profile.update.contact.success';

    /**
     *
     * The USER_PROFILE_UPDATE_CONTACT_COMPLETE event occurs when the profile update process is completed successfully after persisting.
     *
     * This event allows you to modify the values of the profile entity after persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_CONTACT_COMPLETE = 'ccdn_profile.user.profile.update.contact.complete';

    /**
     *
     * The USER_PROFILE_UPDATE_CONTACT_RESPONSE event occurs when the profile update process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileResponseEvent instance.
     */
    const USER_PROFILE_UPDATE_CONTACT_RESPONSE = 'ccdn_profile.user.profile.update.contact.response';

    /**
     *
     * The USER_PROFILE_UPDATE_INFO_INITIALISE event occurs when the profile update process is initalised.
     *
     * This event allows you to modify the default values of the profile entity object before binding the form.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_INFO_INITIALISE = 'ccdn_profile.user.profile.update.info.initialise';

    /**
     *
     * The USER_PROFILE_UPDATE_INFO_SUCCESS event occurs when the profile update process is successful before persisting.
     *
     * This event allows you to modify the values of the profile entity object after form submission before persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_INFO_SUCCESS = 'ccdn_profile.user.profile.update.info.success';

    /**
     *
     * The USER_PROFILE_UPDATE_INFO_COMPLETE event occurs when the profile update process is completed successfully after persisting.
     *
     * This event allows you to modify the values of the profile entity after persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_INFO_COMPLETE = 'ccdn_profile.user.profile.update.info.complete';

    /**
     *
     * The USER_PROFILE_UPDATE_INFO_RESPONSE event occurs when the profile update process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileResponseEvent instance.
     */
    const USER_PROFILE_UPDATE_INFO_RESPONSE = 'ccdn_profile.user.profile.update.info.response';

    /**
     *
     * The USER_PROFILE_UPDATE_PERSONAL_INITIALISE event occurs when the profile update process is initalised.
     *
     * This event allows you to modify the default values of the profile entity object before binding the form.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_PERSONAL_INITIALISE = 'ccdn_profile.user.profile.update.personal.initialise';

    /**
     *
     * The USER_PROFILE_UPDATE_PERSONAL_SUCCESS event occurs when the profile update process is successful before persisting.
     *
     * This event allows you to modify the values of the profile entity object after form submission before persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_PERSONAL_SUCCESS = 'ccdn_profile.user.profile.update.personal.success';

    /**
     *
     * The USER_PROFILE_UPDATE_PERSONAL_COMPLETE event occurs when the profile update process is completed successfully after persisting.
     *
     * This event allows you to modify the values of the profile entity after persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_PERSONAL_COMPLETE = 'ccdn_profile.user.profile.update.personal.complete';

    /**
     *
     * The USER_PROFILE_UPDATE_PERSONAL_RESPONSE event occurs when the profile update process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileResponseEvent instance.
     */
    const USER_PROFILE_UPDATE_PERSONAL_RESPONSE = 'ccdn_profile.user.profile.update.personal.response';

    /**
     *
     * The USER_PROFILE_UPDATE_SIGNATURE_INITIALISE event occurs when the profile update process is initalised.
     *
     * This event allows you to modify the default values of the profile entity object before binding the form.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_SIGNATURE_INITIALISE = 'ccdn_profile.user.profile.update.signature.initialise';

    /**
     *
     * The USER_PROFILE_UPDATE_SIGNATURE_SUCCESS event occurs when the profile update process is successful before persisting.
     *
     * This event allows you to modify the values of the profile entity object after form submission before persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_SIGNATURE_SUCCESS = 'ccdn_profile.user.profile.update.signature.success';

    /**
     *
     * The USER_PROFILE_UPDATE_SIGNATURE_COMPLETE event occurs when the profile update process is completed successfully after persisting.
     *
     * This event allows you to modify the values of the profile entity after persisting.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent instance.
     */
    const USER_PROFILE_UPDATE_SIGNATURE_COMPLETE = 'ccdn_profile.user.profile.update.signature.complete';

    /**
     *
     * The USER_PROFILE_UPDATE_SIGNATURE_RESPONSE event occurs when the profile update process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileResponseEvent instance.
     */
    const USER_PROFILE_UPDATE_SIGNATURE_RESPONSE = 'ccdn_profile.user.profile.update.signature.response';
}
