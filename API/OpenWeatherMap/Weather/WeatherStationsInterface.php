<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface WeatherStationsInterface
 * @package Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather
 */
interface WeatherStationsInterface
{
    /**
     * Base URL for weather stations
     */
    const BASE_URL = 'http://api.openweathermap.org/data/2.5';

    /**
     * Call current weather from one station
     *
     * @param int $stationId
     *
     * @return mixed
     */
    public function fetchFromOnStationById($stationId);

    /**
     * Call current weather from several stations by rectangle zone
     *
     * @param array $boundingBox lon of the top left point, lat of the top left point, lon of the bottom right point, lat of the bottom right point, map zoom
     * @param string $cluster
     * @param int $numberOfStations
     *
     * @return mixed
     */
    public function fetchFromSeveralByRectangleZone(array $boundingBox, $cluster = 'yes', $numberOfStations = 10);

    /**
     * Call current weather from several stations by geo point
     *
     * @param array $boundingBox
     * @param string $cluster
     * @param int $numberOfStations
     *
     * @return mixed
     */
    public function fetchFromSeveralByGeoPoint(array $boundingBox, $cluster = 'yes', $numberOfStations = 10);
}
