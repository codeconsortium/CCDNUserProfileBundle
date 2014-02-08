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

namespace CCDNUser\ProfileBundle\Tests\Unit\Entity\Factory;

use CCDNUser\ProfileBundle\Entity\Factory\ProfileFactory;
use CCDNUser\ProfileBundle\Entity\Profile;

/**
 *
 * @category CCDNUser
 * @package  ProfileBundle
 *
 * @author   Maarten Jacobs <maarten.j.jacobs@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserProfileBundle
 *
 */
class ProfileFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ProfileFactory
     */
    private $profileFactory;

    protected function setUp()
    {
        $this->profileFactory = new ProfileFactory('CCDNUser\ProfileBundle\Entity\Profile');
    }

    public function testDefaultProfileIsEmptyProfile()
    {
        $this->assertEquals(new Profile(), $this->profileFactory->createDefaultProfile());
    }
}
