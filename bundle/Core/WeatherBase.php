<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Core;

use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;

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
    protected $type;

    /**
     * WeatherBase constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface $client
     * @param string $apiKey
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface $cacheService
     * @param string $units
     * @param string $language
     * @param string $type
     */
    public function __construct(HttpClientInterface $client, $apiKey, HandlerInterface $cacheService, $units, $language, $type)
    {
        parent::__construct($client, $apiKey, $cacheService);
        $this->units = $units;
        $this->language = $language;
        $this->type = $type;
    }

    /**
     * Return standard params.
     *
     * @return string
     */
    protected function getParams()
    {
        return '&units=' . $this->units . '&lang=' . $this->language
            . '&type=' . $this->type
            . '&appid=' . $this->apiKey;
    }
}
