<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;

/**
 * Class WeatherStations
 * @package Netgen\Bundle\OpenWeatherMapBundle\Core
 */
class WeatherStations extends Base implements WeatherStationsInterface
{
    /**
     * @var string
     */
    protected $mode;

    /**
     * WeatherStations constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface $client
     * @param string $apiKey
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface $cacheService
     * @param int $ttl
     * @param string $mode
     */
    public function __construct(HttpClientInterface $client, $apiKey, HandlerInterface $cacheService, $ttl, $mode)
    {
        parent::__construct($client, $apiKey, $cacheService, $ttl);
        $this->mode = $mode;
    }

    /**
     * @inheritDoc
     */
    public function fetchFromOnStationById($stationId)
    {
        $queryPart = '/station?id=' . $stationId . '&mode=' . $this->mode . '&appid=' . $this->apiKey;

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchFromSeveralByRectangleZone(array $boundingBox, $cluster = 'yes', $numberOfStations = 10)
    {
        $queryPart = '/box/station?bbox=' . implode(',', $boundingBox)
            . '&cluster=' . $cluster
            . '&cnt=' . $numberOfStations
            . '&appid=' . $this->apiKey;

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchFromSeveralByGeoPoint($latitude, $longitude, $numberOfStations = 10)
    {
        $queryPart = '/station/find?lat=' . $latitude
            . '&lon=' . $longitude
            . '&cnt=' . $numberOfStations
            . '&appid=' . $this->apiKey;

        return $this->getResult(self::BASE_URL, $queryPart);
    }
}
