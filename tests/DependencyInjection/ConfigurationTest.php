<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    protected function getConfiguration()
    {
        return new Configuration();
    }

    public function testConfigurationValuesAreOkAndValid()
    {
        $this->assertConfigurationIsValid(
            [
                'netgen_open_weather_map' => [
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
                            ],
                            'memcached_settings' => [
                                'server' => 'localhost',
                                'port' => 11211,
                            ],
                        ],
                    ],
                ],
            ]
        );
    }

    public function testConfigurationWithApiKeyMissing()
    {
        $this->assertConfigurationIsInvalid(
            [
                'netgen_open_weather_map' => [
                    'system' => [
                        'default' => [
                            'api_settings' => [
                                'api_key' => '',
                                'units' => 'metric',
                                'language' => 'en',
                                'type' => 'accurate',
                            ],
                            'cache_settings' => [
                                'handler' => 'memcached',
                                'ttl' => 3600,
                            ],
                            'memcached_settings' => [
                                'server' => 'localhost',
                                'port' => 11211,
                            ],
                        ],
                    ],
                ],
            ],
            'netgen_open_weather_map.system.default.api_settings.api_key'
        );
    }
}
