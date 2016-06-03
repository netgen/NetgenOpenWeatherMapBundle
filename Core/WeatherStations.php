<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface;

/**
 * Class WeatherStations
 * @package Netgen\Bundle\OpenWeatherMapBundle\Core
 */
class WeatherStations extends Base implements WeatherStationsInterface
{
    /**
     * @inheritDoc
     */
    public function fetchFromOnStationById($stationId)
    {
        $queryPart = '/station?id=' . $stationId . '&appid=' . $this->apiKey;

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
