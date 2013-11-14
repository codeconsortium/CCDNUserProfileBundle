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
 * @category CCDNUser
 * @package  ProfileBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserProfileBundle
 *
 */
class CCDNUserProfileExtension extends Extension
{
    /**
     *
     * @access public
     * @return string
     */
    public function getAlias()
    {
        return 'ccdn_user_profile';
    }

    /**
     *
     * @access public
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('ccdn_user_profile.template.engine', $config['template']['engine']);
        $container->setParameter('ccdn_user_profile.template.pager_theme', $config['template']['pager_theme']);

        // Class file namespaces.
        $this->getEntitySection($config, $container);
        $this->getGatewaySection($config, $container);
        $this->getModelSection($config, $container);
        $this->getRepositorySection($config, $container);
        $this->getManagerSection($config, $container);
        $this->getFormSection($config, $container);
        $this->getComponentSection($config, $container);

        // Configuration stuff.
        $this->getSEOSection($config, $container);
        $this->getMemberSection($config, $container);
        $this->getProfileSection($config, $container);
        $this->getSidebarSection($config, $container);

        // Load Service definitions.
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('services/components.yml');
        $loader->load('services/forms-profile.yml');
        $loader->load('services/model-gateway.yml');
        $loader->load('services/model-repository.yml');
        $loader->load('services/model-manager.yml');
        $loader->load('services/model.yml');
    }

    /**
     *
     * @access private
     * @param  array                                                                $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder              $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getEntitySection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.entity.user.class', $config['entity']['user']['class']);
        $container->setParameter('ccdn_user_profile.entity.profile.class', $config['entity']['profile']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder              $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getGatewaySection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.gateway.user.class', $config['gateway']['user']['class']);
        $container->setParameter('ccdn_user_profile.gateway.profile.class', $config['gateway']['profile']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder              $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getModelSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.model.user.class', $config['model']['user']['class']);
        $container->setParameter('ccdn_user_profile.model.profile.class', $config['model']['profile']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder              $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getRepositorySection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.repository.user.class', $config['repository']['user']['class']);
        $container->setParameter('ccdn_user_profile.repository.profile.class', $config['repository']['profile']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder              $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getManagerSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.manager.user.class', $config['manager']['user']['class']);
        $container->setParameter('ccdn_user_profile.manager.profile.class', $config['manager']['profile']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder              $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getFormSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.form.type.avatar.class', $config['form']['type']['avatar']['class']);
        $container->setParameter('ccdn_user_profile.form.type.personal.class', $config['form']['type']['personal']['class']);
        $container->setParameter('ccdn_user_profile.form.type.info.class', $config['form']['type']['info']['class']);
        $container->setParameter('ccdn_user_profile.form.type.contact.class', $config['form']['type']['contact']['class']);
        $container->setParameter('ccdn_user_profile.form.type.bio.class', $config['form']['type']['bio']['class']);
        $container->setParameter('ccdn_user_profile.form.type.signature.class', $config['form']['type']['signature']['class']);

        $container->setParameter('ccdn_user_profile.form.handler.avatar.class', $config['form']['handler']['avatar']['class']);
        $container->setParameter('ccdn_user_profile.form.handler.personal.class', $config['form']['handler']['personal']['class']);
        $container->setParameter('ccdn_user_profile.form.handler.info.class', $config['form']['handler']['info']['class']);
        $container->setParameter('ccdn_user_profile.form.handler.contact.class', $config['form']['handler']['contact']['class']);
        $container->setParameter('ccdn_user_profile.form.handler.bio.class', $config['form']['handler']['bio']['class']);
        $container->setParameter('ccdn_user_profile.form.handler.signature.class', $config['form']['handler']['signature']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder              $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getComponentSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.component.dashboard.integrator.class', $config['component']['dashboard']['integrator']['class']);
        $container->setParameter('ccdn_user_profile.component.crumb_factory.class', $config['component']['crumb_factory']['class']);
        $container->setParameter('ccdn_user_profile.component.crumb_builder.class', $config['component']['crumb_builder']['class']);
        $container->setParameter('ccdn_user_profile.component.event_listener.flash.class', $config['component']['event_listener']['flash']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder              $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getSEOSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.seo.title_length', $config['seo']['title_length']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                              $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder            $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getMemberSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.member.list.layout_template', $config['member']['list']['layout_template']);
        $container->setParameter('ccdn_user_profile.member.list.members_per_page', $config['member']['list']['members_per_page']);
        $container->setParameter('ccdn_user_profile.member.list.member_since_datetime_format', $config['member']['list']['member_since_datetime_format']);
        $container->setParameter('ccdn_user_profile.member.list.requires_login', $config['member']['list']['requires_login']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder              $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getProfileSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.profile.fallback_avatar', $config['profile']['fallback_avatar']);

        $container->setParameter('ccdn_user_profile.profile.edit.personal.layout_template', $config['profile']['edit']['personal']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.personal.form_theme', $config['profile']['edit']['personal']['form_theme']);

        $container->setParameter('ccdn_user_profile.profile.edit.info.layout_template', $config['profile']['edit']['info']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.info.form_theme', $config['profile']['edit']['info']['form_theme']);

        $container->setParameter('ccdn_user_profile.profile.edit.contact.layout_template', $config['profile']['edit']['contact']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.contact.form_theme', $config['profile']['edit']['contact']['form_theme']);

        $container->setParameter('ccdn_user_profile.profile.edit.avatar.layout_template', $config['profile']['edit']['avatar']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.avatar.form_theme', $config['profile']['edit']['avatar']['form_theme']);

        $container->setParameter('ccdn_user_profile.profile.edit.bio.layout_template', $config['profile']['edit']['bio']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.bio.form_theme', $config['profile']['edit']['bio']['form_theme']);

        $container->setParameter('ccdn_user_profile.profile.edit.signature.layout_template', $config['profile']['edit']['signature']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.edit.signature.form_theme', $config['profile']['edit']['signature']['form_theme']);

        $container->setParameter('ccdn_user_profile.profile.show.requires_login', $config['profile']['show']['requires_login']);

        $container->setParameter('ccdn_user_profile.profile.show.overview.layout_template', $config['profile']['show']['overview']['layout_template']);
        $container->setParameter('ccdn_user_profile.profile.show.overview.member_since_datetime_format', $config['profile']['show']['overview']['member_since_datetime_format']);
        $container->setParameter('ccdn_user_profile.profile.show.overview.last_login_datetime_format', $config['profile']['show']['overview']['last_login_datetime_format']);

        $container->setParameter('ccdn_user_profile.profile.show.bio.layout_template', $config['profile']['show']['bio']['layout_template']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder              $container
     * @return \CCDNUser\ProfileBundle\DependencyInjection\CCDNUserProfileExtension
     */
    private function getSidebarSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ccdn_user_profile.sidebar.links', $config['sidebar']['links']);

        return $this;
    }
}
