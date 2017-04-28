<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    public function testConfigurationValuesAreOkAndValid()
    {
        $this->assertConfigurationIsValid(
            array(
                'netgen_open_weather_map' => array(
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
                ),
            )
        );
    }

    public function testConfigurationValuesAreOkAndValidWithNullHandler()
    {
        $this->assertConfigurationIsValid(
            array(
                'netgen_open_weather_map' => array(
                    'system' => array(
                        'default' => array(
                            'api_settings' => array(
                                'api_key' => 'myApiKey',
                                'units' => 'metric',
                                'language' => 'en',
                                'type' => 'accurate',
                            ),
                            'cache_settings' => array(
                                'handler' => 'null',
                            ),
                        ),
                    ),
                ),
            )
        );
    }

    public function testConfigurationValuesAreOkAndValidWithStashHandler()
    {
        $this->assertConfigurationIsValid(
            array(
                'netgen_open_weather_map' => array(
                    'system' => array(
                        'default' => array(
                            'api_settings' => array(
                                'api_key' => 'myApiKey',
                                'units' => 'metric',
                                'language' => 'en',
                                'type' => 'accurate',
                            ),
                            'cache_settings' => array(
                                'handler' => 'stash',
                                'ttl' => 3600,
                            ),
                        ),
                    ),
                ),
            )
        );
    }

    public function testConfigurationWithApiKeyMissing()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
                    'system' => array(
                        'default' => array(
                            'api_settings' => array(
                                'api_key' => '',
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
                ),
            ),
            'netgen_open_weather_map.system.default.api_settings.api_key'
        );
    }

    public function testConfigurationUnits()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
                    'system' => array(
                        'default' => array(
                            'api_settings' => array(
                                'api_key' => 'myApiKey',
                                'units' => 'something',
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
                ),
            ),
            'netgen_open_weather_map.system.default.api_settings.units'
        );
    }

    public function testConfigurationAccuracyType()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
                    'system' => array(
                        'default' => array(
                            'api_settings' => array(
                                'api_key' => 'myApiKey',
                                'units' => 'metric',
                                'language' => 'en',
                                'type' => 'something',
                            ),
                            'cache_settings' => array(
                                'handler' => 'memcached',
                                'ttl' => 3600,
                                'server' => 'localhost',
                                'port' => 11211,
                            ),
                        ),
                    ),
                ),
            ),
            'netgen_open_weather_map.system.default.api_settings.type'
        );
    }

    public function testConfigurationMemcachedNoTtl()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
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
                                'server' => 'localhost',
                                'port' => 11211,
                            ),
                        ),
                    ),
                ),
            ),
            'Invalid configuration for path "netgen_open_weather_map.system.default.cache_settings": Invalid handler configuration'
        );
    }

    public function testConfigurationMemcachedEmptyTtl()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
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
                                'ttl' => '',
                                'server' => 'localhost',
                                'port' => 11211,
                            ),
                        ),
                    ),
                ),
            ),
            'netgen_open_weather_map.system.default.cache_settings.ttl'
        );
    }

    public function testConfigurationMemcachedNoServer()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
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
                                'ttl' => 100,
                                'port' => 11211,
                            ),
                        ),
                    ),
                ),
            ),
            'Invalid configuration for path "netgen_open_weather_map.system.default.cache_settings": Invalid handler configuration'
        );
    }

    public function testConfigurationMemcachedEmptyServer()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
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
                                'ttl' => 100,
                                'server' => '',
                                'port' => 11211,
                            ),
                        ),
                    ),
                ),
            ),
            'netgen_open_weather_map.system.default.cache_settings.server'
        );
    }

    public function testConfigurationMemcachedNoPort()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
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
                                'server' => 'localhost',
                                'ttl' => 100,
                            ),
                        ),
                    ),
                ),
            ),
            'Invalid configuration for path "netgen_open_weather_map.system.default.cache_settings": Invalid handler configuration'
        );
    }

    public function testConfigurationMemcachedEmptyPort()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
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
                                'ttl' => 100,
                                'server' => 'localhost',
                                'port' => '',
                            ),
                        ),
                    ),
                ),
            ),
            'netgen_open_weather_map.system.default.cache_settings.port'
        );
    }

    public function testConfigurationStashNoTtl()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
                    'system' => array(
                        'default' => array(
                            'api_settings' => array(
                                'api_key' => 'myApiKey',
                                'units' => 'metric',
                                'language' => 'en',
                                'type' => 'accurate',
                            ),
                            'cache_settings' => array(
                                'handler' => 'stash',
                            ),
                        ),
                    ),
                ),
            ),
            'Invalid configuration for path "netgen_open_weather_map.system.default.cache_settings": Invalid handler configuration'
        );
    }

    public function testConfigurationStashEmptyTtl()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
                    'system' => array(
                        'default' => array(
                            'api_settings' => array(
                                'api_key' => 'myApiKey',
                                'units' => 'metric',
                                'language' => 'en',
                                'type' => 'accurate',
                            ),
                            'cache_settings' => array(
                                'handler' => 'stash',
                                'ttl' => '',
                            ),
                        ),
                    ),
                ),
            ),
            'netgen_open_weather_map.system.default.cache_settings.ttl'
        );
    }

    public function testConfigurationNoCacheSettings()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
                    'system' => array(
                        'default' => array(
                            'api_settings' => array(
                                'api_key' => 'myApiKey',
                                'units' => 'metric',
                                'language' => 'en',
                                'type' => 'accurate',
                            ),
                            'cache_settings' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'netgen_open_weather_map.system.default.cache_settings'
        );
    }

    public function testConfigurationCacheSettingsNotArray()
    {
        $this->assertConfigurationIsInvalid(
            array(
                'netgen_open_weather_map' => array(
                    'system' => array(
                        'default' => array(
                            'api_settings' => array(
                                'api_key' => 'myApiKey',
                                'units' => 'metric',
                                'language' => 'en',
                                'type' => 'accurate',
                            ),
                            'cache_settings' => 'cache',
                        ),
                    ),
                ),
            ),
            'netgen_open_weather_map.system.default.cache_settings'
        );
    }

    protected function getConfiguration()
    {
        return new Configuration();
    }
}
