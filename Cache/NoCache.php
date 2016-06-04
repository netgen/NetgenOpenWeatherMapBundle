<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Cache;

/**
 * Class NoCache
 * @package Netgen\Bundle\OpenWeatherMapBundle\Cache
 */
class NoCache implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function has($cacheKey)
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function get($cacheKey)
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function set($cacheKey, $data, $ttl)
    {
    }
}
