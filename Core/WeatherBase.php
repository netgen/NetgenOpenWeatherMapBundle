<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Core;

use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;

/**
 * Class WeatherBase
 * @package Netgen\Bundle\OpenWeatherMapBundle\Core
 */
abstract class WeatherBase extends Base
{
    /**
     * @var string
     */
    protected $units;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $mode;

    /**
     * @var string
     */
    protected $type;

    /**
     * WeatherBase constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface $client
     * @param string $apiKey
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface $cacheService
     * @param int $ttl
     * @param string $units
     * @param string $language
     * @param string $mode
     * @param string $type
     */
    public function __construct(HttpClientInterface $client, $apiKey, HandlerInterface $cacheService, $ttl, $units, $language, $mode, $type)
    {
        parent::__construct($client, $apiKey, $cacheService, $ttl);
        $this->units = $units;
        $this->language = $language;
        $this->mode = $mode;
        $this->type = $type;
    }

    /**
     * Return standard params
     *
     * @return string
     */
    protected function getParams()
    {
        return '&units=' . $this->units . '&lang=' . $this->language
        . '&mode=' . $this->mode . '&type=' . $this->type
        . '&appid=' . $this->apiKey;
    }
}
