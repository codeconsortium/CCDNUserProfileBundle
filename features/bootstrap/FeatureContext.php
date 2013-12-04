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

use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use CCDNUser\ProfileBundle\features\bootstrap\WebUser;

/**
 *
 * Features context.
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
class FeatureContext extends RawMinkContext implements KernelAwareInterface
{
    /**
     *
     * Kernel.
     *
     * @var KernelInterface
     */
    private $kernel;

    /**
     *
     * Parameters.
     *
     * @var array
     */
    private $parameters;

    /**
     *
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
        $this->parameters = $parameters;

        // Web user context.
        $this->useContext('web-user', new WebUser());
    }

    /**
     *
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     *
     * @BeforeScenario
     */
    public function purgeDatabase()
    {
        $entityManager = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');

        $purger = new ORMPurger($entityManager);
        $purger->purge();
    }

    private function getPage()
    {
        return $this->getMainContext()->getSession()->getPage();
    }

    /**
     *
     * @Given /^I am logged in as "([^"]*)"$/
     */
    public function iAmLoggedInAs($user)
    {
        $session = $this->getMainContext()->getSession();
        $session->setBasicAuth($user . '@foo.com', 'root');
    }

    /**
     *
     * @Given /^I select from "([^"]*)" a date "([^"]*)"$/
     */
    public function iSelectFromADate($cssQuery, $dateString)
    {
        $items = $this->getPage()->findAll('css', $cssQuery);

        $fields = array();
        foreach ($items as $item) {
            $id = $item->getAttribute('id');

            if (substr($id, strlen($id) - strlen('year'), strlen($id)) == 'year') {
                $fields['year'] = $item;
                continue;
            }

            if (substr($id, strlen($id) - strlen('month'), strlen($id)) == 'month') {
                $fields['month'] = $item;
                continue;
            }

            if (substr($id, strlen($id) - strlen('day'), strlen($id)) == 'day') {
                $fields['day'] = $item;
                continue;
            }
        }

        WebTestCase::assertCount(3, $fields, 'Date fields could not be found!');
        WebTestCase::assertArrayHasKey('year', $fields, 'The year field could not be found!');
        WebTestCase::assertArrayHasKey('month', $fields, 'The month field could not be found!');
        WebTestCase::assertArrayHasKey('day', $fields, 'The day field could not be found!');

        $date = new \Datetime($dateString);

        $filterFunc = function($options, $has) {
            foreach ($options as $option) {
                if ($option->getText() == $has) {
                    return true;
                }
            }

			ldd($has);
            return false;
        };

        WebTestCase::assertTrue(call_user_func_array($filterFunc, array($fields['year']->findAll('css', 'option'), $date->format('Y'))));
        WebTestCase::assertTrue(call_user_func_array($filterFunc, array($fields['month']->findAll('css', 'option'), $date->format('M'))));
        WebTestCase::assertTrue(call_user_func_array($filterFunc, array($fields['day']->findAll('css', 'option'), $date->format('j'))));

        $fields['year']->selectOption($date->format('Y'));
        $fields['month']->selectOption($date->format('M'));
        $fields['day']->selectOption($date->format('j'));
    }
}
