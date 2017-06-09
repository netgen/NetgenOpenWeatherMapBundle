<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection;

use Marek\OpenWeatherMap\API\Value\Configuration\CacheConfiguration;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Marek\OpenWeatherMap\Constraints\UnitsFormat;
use Marek\OpenWeatherMap\Constraints\SearchAccuracy;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('netgen_open_weather_map');

        $rootNode
            ->children()
                ->arrayNode('api_settings')
                    ->children()
                        ->scalarNode('api_key')
                            ->cannotBeEmpty()
                            ->info('API key from OpenWeatherMap')
                        ->end()
                        ->scalarNode('units')
                            ->validate()
                                ->ifNotInArray(array(UnitsFormat::IMPERIAL, UnitsFormat::METRIC, UnitsFormat::STANDARD))
                                ->thenInvalid('Invalid units parameter %s')
                            ->end()
                            ->info('Standard, metric, and imperial units are available')
                        ->end()
                        ->scalarNode('language')
                            ->cannotBeEmpty()
                            ->info('You can use lang parameter to get the output in your language')
                        ->end()
                        ->scalarNode('type')
                            ->validate()
                                ->ifNotInArray(array(SearchAccuracy::ACCURATE, SearchAccuracy::LIKE))
                                ->thenInvalid('Invalid search accuracy parameter %s')
                            ->end()
                            ->info('Search accuracy')
                        ->end()
                    ->end()
                ->end()
            ->end();

        $rootNode
            ->children()
                ->arrayNode('cache_settings')
                    ->validate()
                        ->ifTrue(function ($v) {
                            if (empty($v)) {
                                return true;
                            }

                            $requiredSettings = array();

                            switch ($v['handler']) {
                                case CacheConfiguration::MEMCACHED:
                                    $requiredSettings = array('ttl', 'server', 'port');
                                    break;
                                case CacheConfiguration::NO_CACHE:
                                    return false;
                            }

                            foreach ($requiredSettings as $setting) {
                                if (!array_key_exists($setting, $v)) {
                                    return true;
                                }
                            }

                            return false;
                        })
                        ->thenInvalid('Invalid handler configuration')
                    ->end()
                    ->children()
                        ->scalarNode('handler')
                            ->cannotBeEmpty()
                            ->info('Cache handler')
                            ->validate()
                                ->ifNotInArray(array(CacheConfiguration::MEMCACHED, CacheConfiguration::NO_CACHE))
                                ->thenInvalid('Invalid cache handler %s')
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
                ->end()
            ->end();

        return $treeBuilder;
    }
}
