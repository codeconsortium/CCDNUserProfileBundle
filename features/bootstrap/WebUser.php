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

use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use CCDNUser\ProfileBundle\features\bootstrap\DataContext;

/**
 *
 * Web user context.
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
class WebUser extends MinkContext implements KernelAwareInterface
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
     * Constructor.
     */
    public function __construct()
    {
        // Bundle data creation context.
        $this->useContext('data', new DataContext());
    }

    /**
     *
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
}
