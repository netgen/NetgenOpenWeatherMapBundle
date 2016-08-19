<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface WeatherStationsInterface.
 */
interface WeatherStationsInterface
{
    /**
     * Base URL for weather stations.
     */
    const BASE_URL = 'http://api.openweathermap.org/data/2.5';

    /**
     * Call current weather from one station.
     *
     * @param int $stationId
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchFromOnStationById($stationId);

    /**
     * Call current weather from several stations by rectangle zone.
     *
     * @param array $boundingBox lon of the top left point, lat of the top left point, lon of the bottom right point, lat of the bottom right point, map zoom
     * @param string $cluster
     * @param int $numberOfStations
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchFromSeveralByRectangleZone(array $boundingBox, $cluster = 'yes', $numberOfStations = 10);

    /**
     * Call current weather from several stations by geo point.
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $numberOfStations
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchFromSeveralByGeoPoint($latitude, $longitude, $numberOfStations = 10);
}
