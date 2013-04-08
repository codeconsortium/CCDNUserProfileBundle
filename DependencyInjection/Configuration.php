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
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
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
                    ->end()
                ->end()
            ->end();

		// Class file namespaces.
		$this->addEntitySection($rootNode);
		$this->addGatewaySection($rootNode);
		$this->addManagerSection($rootNode);
		
		// Configuration stuff.
        $this->addSEOSection($rootNode);
        $this->addProfileSection($rootNode);
        $this->addItemBioSection($rootNode);
        $this->addItemSignatureSection($rootNode);
        $this->addSidebarSection($rootNode);

        return $treeBuilder;
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addEntitySection(ArrayNodeDefinition $node)
	{
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('entity')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
				        ->arrayNode('profile')
		                    ->addDefaultsIfNotSet()
		                    ->canBeUnset()
				            ->children()
								->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Entity\Profile')->end()
							->end()
						->end()
					->end()
				->end()
			->end();
	}
	
    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
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
                        ->arrayNode('profile')
		                    ->addDefaultsIfNotSet()
		                    ->canBeUnset()
                            ->children()
								->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Gateway\ProfileGateway')->end()							
							->end()
						->end()
					->end()
				->end()
			->end();
	}
	
    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
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
                        ->arrayNode('profile')
		                    ->addDefaultsIfNotSet()
		                    ->canBeUnset()
                            ->children()
								->scalarNode('class')->defaultValue('CCDNUser\ProfileBundle\Manager\ProfileManager')->end()							
							->end()
						->end()
					->end()
				->end()
			->end();
	}
	
    /**
     *
     * @access protected
     * @param ArrayNodeDefinition $node
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
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
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
                        ->arrayNode('edit')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('personal')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('form_theme')->defaultValue('CCDNUserProfileBundle:Form:fields.html.twig')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('contact')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('form_theme')->defaultValue('CCDNUserProfileBundle:Form:fields.html.twig')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('avatar')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('form_theme')->defaultValue('CCDNUserProfileBundle:Form:fields.html.twig')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('bio')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('form_theme')->defaultValue('CCDNUserProfileBundle:Form:fields.html.twig')->end()
                                        ->scalarNode('enable_bb_editor')->defaultValue(true)->end()
                                    ->end()
                                ->end()
                                ->arrayNode('signature')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('form_theme')->defaultValue('CCDNUserProfileBundle:Form:fields.html.twig')->end()
                                        ->scalarNode('enable_bb_editor')->defaultValue(true)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('show')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('requires_login')->defaultValue(true)->end()
                                ->arrayNode('overview')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('member_since_datetime_format')->defaultValue('d-m-Y - H:i')->end()
                                        ->scalarNode('last_login_datetime_format')->defaultValue('d-m-Y - H:i')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('bio')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addItemBioSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('item_bio')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('enable_bb_parser')->defaultValue(true)->end()
                    ->end()
                ->end()
            ->end();

    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addItemSignatureSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('item_signature')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('enable_bb_parser')->defaultValue(true)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
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
            ->end();
    }
}
