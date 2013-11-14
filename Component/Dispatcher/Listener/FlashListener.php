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

namespace CCDNUser\ProfileBundle\Component\Dispatcher\Listener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;

use CCDNUser\ProfileBundle\Component\Dispatcher\ProfileEvents;
use CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent;

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
class FlashListener implements EventSubscriberInterface
{
    /**
     *
     * @access private
     * @var \Symfony\Component\HttpFoundation\Session\Session $session
     */
    protected $session;

    /**
     *
     * @access public
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
		    ProfileEvents::USER_PROFILE_UPDATE_AVATAR_COMPLETE    => 'onProfileUpdateComplete',
		    ProfileEvents::USER_PROFILE_UPDATE_BIO_COMPLETE       => 'onProfileUpdateComplete',
		    ProfileEvents::USER_PROFILE_UPDATE_CONTACT_COMPLETE   => 'onProfileUpdateComplete',
		    ProfileEvents::USER_PROFILE_UPDATE_INFO_COMPLETE      => 'onProfileUpdateComplete',
		    ProfileEvents::USER_PROFILE_UPDATE_PERSONAL_COMPLETE  => 'onProfileUpdateComplete',
		    ProfileEvents::USER_PROFILE_UPDATE_SIGNATURE_COMPLETE => 'onProfileUpdateComplete',
        );
    }

    /**
     *
     * @access public
     * @param \CCDNUser\ProfileBundle\Component\Dispatcher\Event\UserProfileEvent $event
     */
    public function onProfileUpdateComplete(UserProfileEvent $event)
    {
        if ($event->getProfile()) {
            if ($event->getProfile()->getId()) {
                $this->session->setFlash('success', 'Successfully updated your Profile');
            }
        }
    }
}
