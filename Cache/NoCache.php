<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Cache;

/**
 * Class NoCache.
 */
class NoCache implements HandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function has($cacheKey)
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function get($cacheKey)
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function set($cacheKey, $data, $ttl)
    {
    }
}
