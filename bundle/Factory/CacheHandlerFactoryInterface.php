<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Factory;

interface CacheHandlerFactoryInterface
{
    /**
     * @return \Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface
     */
    public function getCacheHandler();
}
