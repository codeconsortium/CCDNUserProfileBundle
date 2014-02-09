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

namespace CCDNUser\ProfileBundle\Model\Component\Repository;

use CCDNUser\ProfileBundle\Model\Component\Gateway\ProfileGatewayInterface;

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
class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface
{
    /**
     *
     * @access public
     * @param ProfileGatewayInterface $gateway
     */
    public function __construct(ProfileGatewayInterface $gateway)
    {
        parent::__construct($gateway);
    }
}
