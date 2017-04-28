<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Factory;

use Netgen\Bundle\OpenWeatherMapBundle\Cache\Memcached;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\NoCache;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\Stash;
use Netgen\Bundle\OpenWeatherMapBundle\Factory\CacheHandlerFactory;
use Netgen\Bundle\OpenWeatherMapBundle\Factory\CacheHandlerFactoryInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Tedivm\StashBundle\Service\CacheService;

class CacheHandlerFactoryTest extends TestCase
{
    /**
     * @var CacheHandlerFactoryInterface
     */
    protected $factory;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $container;

    /**
     * @var array
     */
    protected $cacheSettingsNull;

    /**
     * @var array
     */
    protected $cacheSettingsMemcached;

    /**
     * @var array
     */
    protected $cacheSettingsStash;

    public function setUp()
    {
        $this->container = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->setMethods(array('get'))
            ->getMock();

        $this->cacheSettingsNull = array(
            'handler' => 'null',
        );

        $this->cacheSettingsStash = array(
            'handler' => 'stash',
            'ttl' => '100',
        );

        $this->cacheSettingsMemcached = array(
            'handler' => 'memcached',
            'ttl' => '100',
            'server' => '127.0.0.1',
            'port' => '11211',
        );

        $this->factory = new CacheHandlerFactory($this->cacheSettingsNull, $this->container);
    }

    public function testInstanceOfCacheHandlerFactoryInterface()
    {
        $this->assertInstanceOf(CacheHandlerFactoryInterface::class, $this->factory);
    }

    public function testGetNullCacheHandler()
    {
        $this->assertInstanceOf(NoCache::class, $this->factory->getCacheHandler());
    }

    public function testGetMemcachedCacheHandler()
    {
        if (!class_exists(\Memcached::class)) {
            $this->markTestSkipped();
        }

        $this->factory = new CacheHandlerFactory($this->cacheSettingsMemcached, $this->container);

        $this->assertInstanceOf(Memcached::class, $this->factory->getCacheHandler());
    }

    public function testGetInvalidConfiguration()
    {
        $this->factory = new CacheHandlerFactory(array('handler' => 'test'), $this->container);

        $this->assertInstanceOf(NoCache::class, $this->factory->getCacheHandler());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Memcached class do not exist, please install memcached php extension
     */
    public function testGetMemcachedCacheHandlerWithoutMemcachedExtension()
    {
        if (class_exists(\Memcached::class)) {
            $this->markTestSkipped();
        }

        $this->factory = new CacheHandlerFactory($this->cacheSettingsMemcached, $this->container);

        $this->factory->getCacheHandler();
    }

    public function testGetStashCacheHandler()
    {
        $this->factory = new CacheHandlerFactory($this->cacheSettingsStash, $this->container);

        $handler = $this->getMockBuilder(CacheService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->container->expects($this->once())
            ->method('get')
            ->with('stash')
            ->willReturn($handler);

        $this->assertInstanceOf(Stash::class, $this->factory->getCacheHandler());
    }
}
