<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection\NetgenOpenWeatherMapExtension;

class NetgenOpenWeatherMapExtensionTest extends AbstractExtensionTestCase
{
    public function testItSetsValidContainerParameters()
    {
        $this->container->setParameter('ezpublish.siteaccess.list', array());
        $this->load();
    }

    protected function getContainerExtensions()
    {
        return array(
            new NetgenOpenWeatherMapExtension(),
        );
    }

    protected function getMinimalConfiguration()
    {
        return array(
            'system' => array(
                'default' => array(
                    'api_settings' => array(
                        'api_key' => 'myApiKey',
                        'units' => 'metric',
                        'language' => 'en',
                        'type' => 'accurate',
                    ),
                    'cache_settings' => array(
                        'handler' => 'memcached',
                        'ttl' => 3600,
                        'server' => 'localhost',
                        'port' => 11211,
                    ),
                ),
            ),
        );
    }
}
