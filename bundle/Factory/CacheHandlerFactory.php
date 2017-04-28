<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Factory;

use Netgen\Bundle\OpenWeatherMapBundle\Cache\Memcached as MemcachedHandler;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\NoCache;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\Stash;
use Netgen\Bundle\OpenWeatherMapBundle\DependencyInjection\CacheConstraints;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CacheHandlerFactory implements CacheHandlerFactoryInterface
{
    /**
     * @var array
     */
    protected $cacheSettings;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * CacheHandlerFactory constructor.
     *
     * @param array $cacheSettings
     * @param ContainerInterface $container
     */
    public function __construct(array $cacheSettings, ContainerInterface $container)
    {
        $this->cacheSettings = $cacheSettings;
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function getCacheHandler()
    {
        switch ($this->cacheSettings['handler']) {

            case CacheConstraints::MEMCACHED:
                return $this->provideMemcached();

            case CacheConstraints::STASH:
                return $this->provideStash();

            default:
                return new NoCache();

        }
    }

    /**
     * @return MemcachedHandler
     *
     * @throws \Exception
     */
    protected function provideMemcached()
    {

        if (!class_exists(\Memcached::class)) {
            throw new \Exception("Memcached class do not exist, please install memcached php extension");
        }

        $memcached = new \Memcached();
        $memcached->addServer($this->cacheSettings['server'], $this->cacheSettings['port']);

        return new MemcachedHandler($memcached, $this->cacheSettings['ttl']);
    }

    /**
     * @return Stash
     */
    protected function provideStash()
    {
        $stash = $this->container
            ->get('stash');

        return new Stash($stash, $this->cacheSettings['ttl']);
    }
}
