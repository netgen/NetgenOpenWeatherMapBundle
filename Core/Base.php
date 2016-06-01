<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Core;

use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;

/**
 * Class Base
 * @package Netgen\Bundle\OpenWeatherMapBundle\Core
 */
abstract class Base
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface
     */
    protected $cacheService;

    /**
     * @var int
     */
    protected $ttl;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface
     */
    protected $client;

    /**
     * Weather constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface $client
     * @param string $apiKey
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface $cacheService
     * @param int $ttl
     */
    public function __construct(HttpClientInterface $client, $apiKey, HandlerInterface $cacheService, $ttl)
    {
        $this->apiKey = $apiKey;
        $this->cacheService = $cacheService;
        $this->ttl = $ttl;
        $this->client = $client;
    }

    /**
     * Helper method
     *
     * @param string $baseUrl
     * @param string $queryPart
     *
     * @return mixed
     */
    protected function getResult($baseUrl, $queryPart)
    {
        $url = $baseUrl . $queryPart;

        $hash = md5($url);

        if ($this->cacheService->has($hash)) {

            return $this->cacheService->get($hash);

        } else {

            $result = $this->client->get($url);

            $this->cacheService->set($hash, $result, $this->ttl);

            return $result;

        }
    }
}
