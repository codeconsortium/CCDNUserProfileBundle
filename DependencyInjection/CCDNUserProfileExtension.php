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

namespace CCDNUser\ProfileBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

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
     *
     * @access private
	 * @param array $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

		// Class file namespaces.
        $this->getEntitySection($config, $container);
        $this->getRepositorySection($config, $container);
        $this->getGatewaySection($config, $container);
        $this->getManagerSection($config, $container);
		$this->getFormSection($config, $container);
		$this->getComponentSection($config, $container);
		
		// Configuration stuff.
        $container->setParameter('ccdn_user_profile.template.engine', $config['template']['engine']);
        $this->getSEOSection($config, $container);
        $this->getProfileSection($config, $container);
        $this->getItemBioSection($config, $container);
        $this->getItemSignatureSection($config, $container);
        $this->getSidebarSection($config, $container);
		
		// Load Service definitions.
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function getEntitySection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.entity.profile.class', $config['entity']['profile']['class']);				
	}
	
    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function getRepositorySection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.repository.profile.class', $config['repository']['profile']['class']);
	}
	
    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function getGatewaySection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.gateway.profile.class', $config['gateway']['profile']['class']);
	}
	
    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function getManagerSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.manager.profile.class', $config['manager']['profile']['class']);		
	}
	
    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function getFormSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.form.type.avatar.class', $config['form']['type']['avatar']['class']);
        $container->setParameter('ccdn_user_profile.form.type.bio.class', $config['form']['type']['bio']['class']);
        $container->setParameter('ccdn_user_profile.form.type.contact.class', $config['form']['type']['contact']['class']);
        $container->setParameter('ccdn_user_profile.form.type.personal.class', $config['form']['type']['personal']['class']);
        $container->setParameter('ccdn_user_profile.form.type.signature.class', $config['form']['type']['signature']['class']);

        $container->setParameter('ccdn_user_profile.form.handler.avatar.class', $config['form']['handler']['avatar']['class']);
        $container->setParameter('ccdn_user_profile.form.handler.bio.class', $config['form']['handler']['bio']['class']);
        $container->setParameter('ccdn_user_profile.form.handler.contact.class', $config['form']['handler']['contact']['class']);
        $container->setParameter('ccdn_user_profile.form.handler.personal.class', $config['form']['handler']['personal']['class']);
        $container->setParameter('ccdn_user_profile.form.handler.signature.class', $config['form']['handler']['signature']['class']);
	}
	
    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function getComponentSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.component.dashboard.integrator.class', $config['component']['dashboard']['integrator']['class']);		
	}
	
    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    protected function getSEOSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.seo.title_length', $config['seo']['title_length']);
    }

    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function getProfileSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.profile.edit.personal.layout_template', $config['profile']['edit']['personal']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.personal.form_theme', $config['profile']['edit']['personal']['form_theme']);

        $container->setParameter('ccdn_user_profile.profile.edit.contact.layout_template', $config['profile']['edit']['contact']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.contact.form_theme', $config['profile']['edit']['contact']['form_theme']);

        $container->setParameter('ccdn_user_profile.profile.edit.avatar.layout_template', $config['profile']['edit']['avatar']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.avatar.form_theme', $config['profile']['edit']['avatar']['form_theme']);

        $container->setParameter('ccdn_user_profile.profile.edit.bio.layout_template', $config['profile']['edit']['bio']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.bio.form_theme', $config['profile']['edit']['bio']['form_theme']);
        $container->setParameter('ccdn_user_profile.profile.edit.bio.enable_bb_editor', $config['profile']['edit']['bio']['enable_bb_editor']);

        $container->setParameter('ccdn_user_profile.profile.edit.signature.layout_template', $config['profile']['edit']['signature']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.signature.form_theme', $config['profile']['edit']['signature']['form_theme']);
        $container->setParameter('ccdn_user_profile.profile.edit.signature.enable_bb_editor', $config['profile']['edit']['signature']['enable_bb_editor']);

        $container->setParameter('ccdn_user_profile.profile.show.requires_login', $config['profile']['show']['requires_login']);

        $container->setParameter('ccdn_user_profile.profile.show.overview.layout_template', $config['profile']['show']['overview']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.show.overview.member_since_datetime_format', $config['profile']['show']['overview']['member_since_datetime_format']);
        $container->setParameter('ccdn_user_profile.profile.show.overview.last_login_datetime_format', $config['profile']['show']['overview']['last_login_datetime_format']);

        $container->setParameter('ccdn_user_profile.profile.show.bio.layout_template', $config['profile']['show']['bio']['layout_template']);
    }

    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function getItemBioSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.item_bio.enable_bb_parser', $config['item_bio']['enable_bb_parser']);
    }

    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function getItemSignatureSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.item_signature.enable_bb_parser', $config['item_signature']['enable_bb_parser']);
    }

    /**
     *
     * @access private
     * @param array $config
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    private function getSidebarSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.sidebar.links', $config['sidebar']['links']);
    }
}
