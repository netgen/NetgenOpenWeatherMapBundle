<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Cache;

/**
 * Class Null
 * @package Netgen\Bundle\OpenWeatherMapBundle\Cache
 */
class Null implements HandlerInterface
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
