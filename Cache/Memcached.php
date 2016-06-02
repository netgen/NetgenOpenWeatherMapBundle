<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Cache;

use Memcached as MemcachedStore;

/**
 * Class Memcached
 * @package Netgen\Bundle\OpenWeatherMapBundle\Cache
 */
class Memcached implements HandlerInterface
{
    /**
     * @var \Memcached
     */
    protected $memcached;

    /**
     * Memcached constructor.
     *
     * @param \Memcached $memcached
     */
    public function __construct(\Memcached $memcached)
    {
        $this->memcached = $memcached;
        $this->memcached->setOption(MemcachedStore::OPT_PREFIX_KEY, self::CACHE_KEY_PREFIX);
        $this->memcached->setOption(MemcachedStore::OPT_LIBKETAMA_COMPATIBLE, true);
    }

    /**
     * @inheritdoc
     */
    public function has($cacheKey)
    {
        return $this->memcached->get($cacheKey) !== false;
    }

    /**
     * @inheritdoc
     */
    public function get($cacheKey)
    {
        return $this->memcached->get($cacheKey);
    }

    /**
     * @inheritdoc
     */
    public function set($cacheKey, $data, $ttl)
    {
        $realTtl = (int) $ttl;

        // Memcached considers TTL smaller than 60 * 60 * 24 * 30 (number of seconds in a month)
        // as a relative value, so we will make sure that it is converted to a timestamp for consistent
        // usage later on
        if ($realTtl < 60 * 60 * 24 * 30) {
            $realTtl = time() + $realTtl;
        }

        $this->memcached->set($cacheKey, $data, $realTtl);
    }
}
