<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class CacheHandlerFactory
 * @package Netgen\Bundle\OpenWeatherMapBundle\Factory
 */
class CacheHandlerFactory
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * CacheHandlerFactory constructor.
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

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
