<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Factory;

use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Class CacheHandlerFactory.
 */
class CacheHandlerFactory extends ContainerAware
{
    /**
     * Returns cache handler for specified identifier.
     *
     * @param string $cacheHandlerIdentifier
     *
     * @return \Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface
     */
    public function getCacheHandler($cacheHandlerIdentifier)
    {
        return $this->container->get('netgen_openweathermap.cache_handler.' . $cacheHandlerIdentifier);
    }
}
