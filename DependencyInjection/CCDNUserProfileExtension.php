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
        $this->getItemBioSection($container, $config);
        $this->getItemSignatureSection($container, $config);
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
     * @param $container, $config
     */
    private function getItemBioSection($container, $config)
    {
        $container->setParameter('ccdn_user_profile.item_bio.enable_bb_parser', $config['item_bio']['enable_bb_parser']);
    }

    /**
     *
     * @access private
     * @param $container, $config
     */
    private function getItemSignatureSection($container, $config)
    {
        $container->setParameter('ccdn_user_profile.item_signature.enable_bb_parser', $config['item_signature']['enable_bb_parser']);
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
