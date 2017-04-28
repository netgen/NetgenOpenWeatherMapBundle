<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\Configuration as SiteAccessConfiguration;

/**
 * This is the class that validates and merges configuration from your app/config files.
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

        $builder = $this->generateScopeBaseNode($rootNode);

        $builder
            ->arrayNode('api_settings')
                ->children()
                    ->scalarNode('api_key')
                        ->cannotBeEmpty()
                        ->info('API key from OpenWeatherMap')
                    ->end()
                    ->scalarNode('units')
                        ->validate()
                            ->ifNotInArray(array(UnitsConstraints::IMPERIAL, UnitsConstraints::METRIC, UnitsConstraints::STANDARD))
                            ->thenInvalid("Invalid units parameter %s")
                        ->end()
                        ->info('Standard, metric, and imperial units are available')
                    ->end()
                    ->scalarNode('language')
                        ->cannotBeEmpty()
                        ->info('You can use lang parameter to get the output in your language')
                    ->end()
                    ->scalarNode('type')
                        ->validate()
                            ->ifNotInArray(array(SearchAccuracyConstraints::ACCURATE, SearchAccuracyConstraints::LIKE))
                            ->thenInvalid("Invalid search accuracy parameter %s")
                        ->end()
                        ->info('Search accuracy')
                    ->end()
                ->end()
            ->end();

        $builder
            ->arrayNode('cache_settings')
                ->validate()
                    ->ifTrue(function($v) {

                        if (empty($v)) {
                            return true;
                        }

                        $requiredSettings = array();

                        switch($v['handler']) {
                            case 'memcached':
                                $requiredSettings = ['ttl', 'server', 'port'];
                                break;
                            case 'stash':
                                $requiredSettings = ['ttl'];
                                break;
                            case 'null':
                                return false;
                        }

                        foreach ($requiredSettings as $setting) {

                            if (!array_key_exists($setting, $v)) {
                                return true;
                            }
                        }

                        return false;
                    })
                    ->thenInvalid("Invalid handler configuration")
                ->end()
                ->children()
                    ->scalarNode('handler')
                        ->cannotBeEmpty()
                        ->info('Cache handler')
                        ->validate()
                            ->ifNotInArray(['stash', 'memcached', 'null'])
                            ->thenInvalid("Invalid cache handler %s")
                        ->end()
                    ->end()
                    ->scalarNode('ttl')
                        ->cannotBeEmpty()
                        ->info('Cache ttl in seconds')
                    ->end()
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
