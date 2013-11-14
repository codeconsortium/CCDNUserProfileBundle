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

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
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
class Configuration implements ConfigurationInterface
{
    /**
     *
     * @access protected
     * @var string $defaultValueLayoutTemplate
     */
    protected $defaultValueLayoutTemplate = 'CCDNUserProfileBundle::base.html.twig';

    /**
     *
     * @access protected
     * @var string $defaultValueFormTheme
     */
    protected $defaultValueFormTheme = 'CCDNUserProfileBundle:Common:Form/fields.html.twig';

    /**
     *
     * @access protected
     * @var string $defaultValueAvatarUrl
     */
    protected $defaultValueAvatarUrl = '/bundles/ccdnuserprofile/img/avatar_anonymous.gif';

    /**
     *
     * @access public
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ccdn_user_profile');

        $rootNode
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('template')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('engine')->defaultValue('twig')->end()
                        ->scalarNode('pager_theme')->defaultValue('CCDNUserProfileBundle:Common:Paginator/twitter_bootstrap.html.twig')->end()
                    ->end()
                ->end()
            ->end()
        ;

        // Class file namespaces.
        $this->addEntitySection($rootNode);
        $this->addGatewaySection($rootNode);
        $this->addModelSection($rootNode);
        $this->addRepositorySection($rootNode);
        $this->addManagerSection($rootNode);
        $this->addFormSection($rootNode);
        $this->addComponentSection($rootNode);

        // Configuration stuff.
        $this->addSEOSection($rootNode);
        $this->addMemberSection($rootNode);
        $this->addProfileSection($rootNode);
        $this->addSidebarSection($rootNode);

        return $treeBuilder;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    private function addEntitySection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('entity')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->children()
                        ->arrayNode('user')
		                    ->isRequired()
		                    ->cannotBeEmpty()
                            ->children()
                                ->scalarNode('class')
				                    ->isRequired()
				                    ->cannotBeEmpty()
								->end()
                            ->end()
                        ->end()
                        ->arrayNode('profile')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Entity\Profile')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    private function addModelSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('model')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('user')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Model\Model\UserModel')->end()
                            ->end()
                        ->end()
                        ->arrayNode('profile')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Model\Model\ProfileModel')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    private function addGatewaySection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('gateway')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('user')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Model\Gateway\UserGateway')->end()
                            ->end()
                        ->end()
                        ->arrayNode('profile')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Model\Gateway\ProfileGateway')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    private function addRepositorySection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('repository')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('user')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Model\Repository\UserRepository')->end()
                            ->end()
                        ->end()
                        ->arrayNode('profile')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Model\Repository\ProfileRepository')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }


    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    private function addManagerSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('manager')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('user')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Model\Manager\UserManager')->end()
                            ->end()
                        ->end()
                        ->arrayNode('profile')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Model\Manager\ProfileManager')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    private function addFormSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('form')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('type')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('avatar')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Type\User\Profile\AvatarFormType')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('personal')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Type\User\Profile\PersonalFormType')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('info')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Type\User\Profile\InfoFormType')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('contact')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Type\User\Profile\ContactFormType')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('bio')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Type\User\Profile\BioFormType')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('signature')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Type\User\Profile\SignatureFormType')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('handler')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('avatar')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateAvatarFormHandler')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('personal')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdatePersonalFormHandler')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('info')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateInfoFormHandler')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('contact')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateContactFormHandler')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('bio')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateBioFormHandler')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('signature')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateSignatureFormHandler')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    private function addComponentSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('component')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('dashboard')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('integrator')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Component\Dashboard\DashboardIntegrator')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('crumb_factory')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbFactory')->end()
                            ->end()
                        ->end()
                        ->arrayNode('crumb_builder')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Component\Crumbs\CrumbBuilder')->end()
                            ->end()
                        ->end()
                        ->arrayNode('event_listener')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('flash')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Component\Dispatcher\Listener\FlashListener')->end()
                                    ->end()
                                ->end()
							->end()
						->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access protected
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    protected function addSEOSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('seo')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('title_length')->defaultValue('67')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    private function addMemberSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('member')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('list')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('layout_template')->defaultValue($this->defaultValueLayoutTemplate)->end()
                                ->scalarNode('members_per_page')->defaultValue(50)->end()
                                ->scalarNode('member_since_datetime_format')->defaultValue('d-m-Y - H:i')->end()
                                ->scalarNode('requires_login')->defaultValue(false)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    private function addProfileSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('profile')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('fallback_avatar')->defaultValue($this->defaultValueAvatarUrl)->end()
						->arrayNode('edit')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('personal')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue($this->defaultValueLayoutTemplate)->end()
                                        ->scalarNode('form_theme')->defaultValue($this->defaultValueFormTheme )->end()
                                    ->end()
                                ->end()
                                ->arrayNode('info')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue($this->defaultValueLayoutTemplate)->end()
                                        ->scalarNode('form_theme')->defaultValue($this->defaultValueFormTheme )->end()
                                    ->end()
                                ->end()
                                ->arrayNode('contact')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue($this->defaultValueLayoutTemplate)->end()
                                        ->scalarNode('form_theme')->defaultValue($this->defaultValueFormTheme )->end()
                                    ->end()
                                ->end()
                                ->arrayNode('avatar')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue($this->defaultValueLayoutTemplate)->end()
                                        ->scalarNode('form_theme')->defaultValue($this->defaultValueFormTheme )->end()
                                    ->end()
                                ->end()
                                ->arrayNode('bio')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue($this->defaultValueLayoutTemplate)->end()
                                        ->scalarNode('form_theme')->defaultValue($this->defaultValueFormTheme )->end()
                                    ->end()
                                ->end()
                                ->arrayNode('signature')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue($this->defaultValueLayoutTemplate)->end()
                                        ->scalarNode('form_theme')->defaultValue($this->defaultValueFormTheme )->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('show')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('requires_login')->defaultValue(false)->end()
                                ->arrayNode('overview')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue($this->defaultValueLayoutTemplate)->end()
                                        ->scalarNode('member_since_datetime_format')->defaultValue('d-m-Y - H:i')->end()
                                        ->scalarNode('last_login_datetime_format')->defaultValue('d-m-Y - H:i')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('bio')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue($this->defaultValueLayoutTemplate)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \CCDNUser\ProfileBundle\DependencyInjection\Configuration
     */
    private function addSidebarSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('sidebar')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('links')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('bundle')->end()
                                    ->scalarNode('label')->end()
                                    ->scalarNode('route')->defaultNull()->end()
                                    ->scalarNode('path')->defaultNull()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }
}
