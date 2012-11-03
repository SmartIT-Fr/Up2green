<?php

namespace Up2green\EducationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('up2green_education');

        $rootNode
           ->children()
           ->scalarNode('trees_by_kit')
               ->defaultValue('30')
               ->end()
           ->scalarNode('kit_price')
               ->defaultValue('150')
               ->end()
           ->end();

        return $treeBuilder;
    }
}
