<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection;

use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\ConfigurationProcessor;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\ContextualizerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class NetgenOpenWeatherMapExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        
        $processor = new ConfigurationProcessor( $container, 'netgen_open_weather_map' );
        $configArrays = array('api_settings', 'cache_settings', 'memcached_settings');

        $scopes = array_merge(array('default'), $container->getParameter('ezpublish.siteaccess.list'));

        foreach ($configArrays as $configArray) {
            $processor->mapConfigArray($configArray, $config);

            foreach ($scopes as $scope) {
                $scopeConfig = $container->getParameter('netgen_open_weather_map.' . $scope . '.' . $configArray);
                foreach ($scopeConfig as $key => $value) {
                    $container->setParameter(
                        'netgen_open_weather_map.' . $scope . '.' . $configArray . '.' . $key,
                        $value
                    );
                }
            }
        }
    }
}
