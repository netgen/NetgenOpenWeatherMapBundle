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

        $systemNode = $this->generateScopeBaseNode($rootNode);

        $systemNode->scalarNode('weather_api_key')
            ->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('weather_url')
            ->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('weather_image_url')
            ->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('image_location')
            ->isRequired()->end();

        return $treeBuilder;
    }
}
