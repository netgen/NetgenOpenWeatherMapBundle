<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface HourForecastInterface
 * @package Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather
 */
interface HourForecastInterface
{
    /**
     * Call 5 day / 3 hour forecast data by city name
     *
     * @param string $cityName
     * @param string $countryCode
     *
     * @return mixed
     */
    public function fetchForecastByCityName($cityName, $countryCode = '');

    /**
     * Call 5 day / 3 hour forecast data by city id
     *
     * @param int $cityId
     *
     * @return mixed
     */
    public function fetchForecastByCityId($cityId);

    /**
     * Call 5 day / 3 hour forecast data by geographic coordinates
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @return mixed
     */
    public function fetchForecastByCityGeographicCoordinates($latitude, $longitude);
}
