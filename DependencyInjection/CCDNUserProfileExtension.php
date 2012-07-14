<?php

/*
 * This file is part of the CCDN ProfileBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 
 * 
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNUser\ProfileBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class CCDNUserProfileExtension extends Extension
{
	
	
	
    /**
     * {@inheritDoc}
     */
	public function getAlias()
	{
		return 'ccdn_user_profile';
	}
	
	
	
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

		$container->setParameter('ccdn_user_profile.user.profile_route', $config['user']['profile_route']);
		$container->setParameter('ccdn_user_profile.template.engine', $config['template']['engine']);
		
		$this->getSEOSection($container, $config);
		$this->getProfileSection($container, $config);
		$this->getSidebarSection($container, $config);
    }
	
	
	
	/**
	 *
	 * @access protected
	 * @param $container, $config
	 */
	protected function getSEOSection($container, $config)
	{
	    $container->setParameter('ccdn_user_profile.seo.title_length', $config['seo']['title_length']);
	}
	
	
	
	/**
	 *
	 * @access private
	 * @param $container, $config
	 */
	private function getProfileSection($container, $config)
	{
		$container->setParameter('ccdn_user_profile.profile.edit.layout_template', $config['profile']['edit']['layout_template']);
		$container->setParameter('ccdn_user_profile.profile.edit.form_theme', $config['profile']['edit']['form_theme']);
		
		$container->setParameter('ccdn_user_profile.profile.show.layout_template', $config['profile']['show']['layout_template']);
		$container->setParameter('ccdn_user_profile.profile.show.member_since_datetime_format', $config['profile']['show']['member_since_datetime_format']);
		$container->setParameter('ccdn_user_profile.profile.show.last_login_datetime_format', $config['profile']['show']['last_login_datetime_format']);
		$container->setParameter('ccdn_user_profile.profile.show.requires_login', $config['profile']['show']['requires_login']);
		
	}
	
	
	
	/**
	 *
	 * @access private
	 * @param $container, $config
	 */
	private function getSidebarSection($container, $config)
	{
		$container->setParameter('ccdn_user_profile.sidebar.members_route', $config['sidebar']['members_route']);
		$container->setParameter('ccdn_user_profile.sidebar.account_route', $config['sidebar']['account_route']);
		$container->setParameter('ccdn_user_profile.sidebar.registration_route', $config['sidebar']['registration_route']);
		$container->setParameter('ccdn_user_profile.sidebar.login_route', $config['sidebar']['login_route']);
		$container->setParameter('ccdn_user_profile.sidebar.logout_route', $config['sidebar']['logout_route']);
		$container->setParameter('ccdn_user_profile.sidebar.reset_route', $config['sidebar']['reset_route']);	
		
	}
	
}
