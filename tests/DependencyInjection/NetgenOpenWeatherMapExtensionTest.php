<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection\NetgenOpenWeatherMapExtension;

class NetgenOpenWeatherMapExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return [
            new NetgenOpenWeatherMapExtension(),
        ];
    }

    public function testItSetsValidContainerParameters()
    {
        $this->container->setParameter('ezpublish.siteaccess.list', []);
        $this->load();
    }

    protected function getMinimalConfiguration()
    {
        return [
            'system' => [
                'default' => [
                    'api_settings' => [
                        'api_key' => 'myApiKey',
                        'units' => 'metric',
                        'language' => 'en',
                        'type' => 'accurate',
                    ],
                    'cache_settings' => [
                        'handler' => 'memcached',
                        'ttl' => 3600,
                        'server' => 'localhost',
                        'port' => 11211,
                    ],
                ],
            ],
        ];
    }
}
