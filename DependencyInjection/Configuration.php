<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\Configuration as SiteAccessConfiguration;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration extends SiteAccessConfiguration
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('netgen_open_weather_map');

        $this->generateScopeBaseNode($rootNode)
            ->arrayNode('api_settings')
                ->children()
                    ->scalarNode('weather_api_key')
                        ->cannotBeEmpty()
                        ->info('API key from OpenWeatherMap')
                    ->end()
                    ->scalarNode('weather_url')
                        ->cannotBeEmpty()
                        ->info('Base URL for OpenWeatherMap')
                    ->end()
                    ->scalarNode('units')
                        ->cannotBeEmpty()
                        ->info('Standard, metric, and imperial units are available')
                    ->end()
                    ->scalarNode('language')
                        ->cannotBeEmpty()
                        ->info('You can use lang parameter to get the output in your language')
                    ->end()
                    ->scalarNode('mode')
                        ->cannotBeEmpty()
                        ->info('JSON format is used by default. To get data in XML or HTML formats just set up mode = xml or html')
                    ->end()
                    ->scalarNode('type')
                        ->cannotBeEmpty()
                        ->info('Search accuracy')
                    ->end()
                ->end()
            ->end()
            ->arrayNode('cache_settings')
                ->children()
                    ->scalarNode('handler')
                        ->cannotBeEmpty()
                        ->info('Cache handler')
                    ->end()
                    ->scalarNode('ttl')
                        ->cannotBeEmpty()
                        ->info('Cache ttl in seconds')
                    ->end()
                ->end()
            ->end()
            ->arrayNode('memcached_settings')
                ->children()
                    ->scalarNode('server')
                        ->cannotBeEmpty()
                        ->info('Memcached server IP address')
                    ->end()
                    ->scalarNode('port')
                        ->cannotBeEmpty()
                        ->info('Memcached server port')
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
