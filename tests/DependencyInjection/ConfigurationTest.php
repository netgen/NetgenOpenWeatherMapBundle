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
                                'server' => 'localhost',
                                'port' => 11211,
                            ],
                        ],
                    ],
                ],
            ]
        );
    }

    public function testConfigurationValuesAreOkAndValidWithNullHandler()
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
                                'handler' => 'null',
                            ],
                        ],
                    ],
                ],
            ]
        );
    }

    public function testConfigurationValuesAreOkAndValidWithStashHandler()
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
                                'handler' => 'stash',
                                'ttl' => 3600,
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

    public function testConfigurationUnits()
    {
        $this->assertConfigurationIsInvalid(
            [
                'netgen_open_weather_map' => [
                    'system' => [
                        'default' => [
                            'api_settings' => [
                                'api_key' => 'myApiKey',
                                'units' => 'something',
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
                ],
            ],
            'netgen_open_weather_map.system.default.api_settings.units'
        );
    }

    public function testConfigurationAccuracyType()
    {
        $this->assertConfigurationIsInvalid(
            [
                'netgen_open_weather_map' => [
                    'system' => [
                        'default' => [
                            'api_settings' => [
                                'api_key' => 'myApiKey',
                                'units' => 'metric',
                                'language' => 'en',
                                'type' => 'something',
                            ],
                            'cache_settings' => [
                                'handler' => 'memcached',
                                'ttl' => 3600,
                                'server' => 'localhost',
                                'port' => 11211,
                            ],
                        ],
                    ],
                ],
            ],
            'netgen_open_weather_map.system.default.api_settings.type'
        );
    }

    public function testConfigurationMemcachedNoTtl()
    {
        $this->assertConfigurationIsInvalid(
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
                                'server' => 'localhost',
                                'port' => 11211,
                            ],
                        ],
                    ],
                ],
            ],
            'Invalid configuration for path "netgen_open_weather_map.system.default.cache_settings": Invalid handler configuration'
        );
    }

    public function testConfigurationMemcachedEmptyTtl()
    {
        $this->assertConfigurationIsInvalid(
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
                                'ttl' => '',
                                'server' => 'localhost',
                                'port' => 11211,
                            ],
                        ],
                    ],
                ],
            ],
            'netgen_open_weather_map.system.default.cache_settings.ttl'
        );
    }

    public function testConfigurationMemcachedNoServer()
    {
        $this->assertConfigurationIsInvalid(
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
                                'ttl' => 100,
                                'port' => 11211,
                            ],
                        ],
                    ],
                ],
            ],
            'Invalid configuration for path "netgen_open_weather_map.system.default.cache_settings": Invalid handler configuration'
        );
    }

    public function testConfigurationMemcachedEmptyServer()
    {
        $this->assertConfigurationIsInvalid(
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
                                'ttl' => 100,
                                'server' => '',
                                'port' => 11211,
                            ],
                        ],
                    ],
                ],
            ],
            'netgen_open_weather_map.system.default.cache_settings.server'
        );
    }

    public function testConfigurationMemcachedNoPort()
    {
        $this->assertConfigurationIsInvalid(
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
                                'server' => 'localhost',
                                'ttl' => 100,
                            ],
                        ],
                    ],
                ],
            ],
            'Invalid configuration for path "netgen_open_weather_map.system.default.cache_settings": Invalid handler configuration'
        );
    }

    public function testConfigurationMemcachedEmptyPort()
    {
        $this->assertConfigurationIsInvalid(
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
                                'ttl' => 100,
                                'server' => 'localhost',
                                'port' => '',
                            ],
                        ],
                    ],
                ],
            ],
            'netgen_open_weather_map.system.default.cache_settings.port'
        );
    }

    public function testConfigurationStashNoTtl()
    {
        $this->assertConfigurationIsInvalid(
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
                                'handler' => 'stash',
                            ],
                        ],
                    ],
                ],
            ],
            'Invalid configuration for path "netgen_open_weather_map.system.default.cache_settings": Invalid handler configuration'
        );
    }

    public function testConfigurationStashEmptyTtl()
    {
        $this->assertConfigurationIsInvalid(
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
                                'handler' => 'stash',
                                'ttl' => '',
                            ],
                        ],
                    ],
                ],
            ],
            'netgen_open_weather_map.system.default.cache_settings.ttl'
        );
    }

    public function testConfigurationNoCacheSettings()
    {
        $this->assertConfigurationIsInvalid(
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
                            ],
                        ],
                    ],
                ],
            ],
            'netgen_open_weather_map.system.default.cache_settings'
        );
    }

    public function testConfigurationCacheSettingsNotArray()
    {
        $this->assertConfigurationIsInvalid(
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
                            'cache_settings' => 'cache',
                        ],
                    ],
                ],
            ],
            'netgen_open_weather_map.system.default.cache_settings'
        );
    }
}
