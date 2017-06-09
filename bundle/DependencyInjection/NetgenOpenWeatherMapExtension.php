<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class NetgenOpenWeatherMapExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $apiConfiguration = $container->getDefinition('netgen_open_weather_map.factory.api_configuration');
        $cacheConfiguration = $container->getDefinition('netgen_open_weather_map.factory.cache_configuration');

        $apiConfiguration->replaceArgument(0, $config['api_settings']['api_key']);
        $apiConfiguration->replaceArgument(1, $config['api_settings']['units']);
        $apiConfiguration->replaceArgument(2, $config['api_settings']['language']);
        $apiConfiguration->replaceArgument(3, $config['api_settings']['type']);


        $cacheConfiguration->replaceArgument(0, $config['cache_settings']['handler']);
        $cacheConfiguration->replaceArgument(1, $config['cache_settings']['ttl']);
        $cacheConfiguration->replaceArgument(2, $config['cache_settings']['server']);
        $cacheConfiguration->replaceArgument(3, $config['cache_settings']['port']);
    }
}
