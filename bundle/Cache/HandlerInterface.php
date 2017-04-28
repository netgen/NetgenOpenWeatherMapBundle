<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Cache;

interface HandlerInterface
{
    /**
     * @const string
     */
    const CACHE_KEY_PREFIX = 'netgen-openweathermap-';

    /**
     * Returns if there is a valid cache entry for provided cache key.
     *
     * @param string $cacheKey
     *
     * @return bool
     */
    public function has($cacheKey);

    /**
     * Returns the data from cache entry for provided cache key.
     *
     * @param string $cacheKey
     *
     * @return string
     *
     * @throws
     */
    public function get($cacheKey);

    /**
     * Sets the data to cache entry for provided cache key.
     *
     * @param string $cacheKey
     *
     * @param string $data
     */
    public function set($cacheKey, $data);
}
