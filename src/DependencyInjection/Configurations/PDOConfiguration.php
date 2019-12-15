<?php

namespace WorldFactory\QQ\Extensions\Pdo\DependencyInjection\Configurations;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class PDOConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('qq_extensions_pdo');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('connections')
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('dsn')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('user')->defaultNull()->end()
                            ->scalarNode('pass')->defaultNull()->end()
                            ->arrayNode('options')->end()
                            ->booleanNode('persist')->defaultTrue()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}