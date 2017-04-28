<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Cache;

use Netgen\Bundle\OpenWeatherMapBundle\Exception\ItemNotFoundException;

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
        throw new ItemNotFoundException("Item with key:{$cacheKey} not found.");
    }

    /**
     * {@inheritdoc}
     */
    public function set($cacheKey, $data)
    {
    }
}
