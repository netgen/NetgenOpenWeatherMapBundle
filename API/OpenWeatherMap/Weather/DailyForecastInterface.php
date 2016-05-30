<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface DailyForecastInterface
 * @package Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather
 */
interface DailyForecastInterface
{
    /**
     * Call 16 day / daily forecast data by city name
     *
     * @param string $cityName
     * @param string $countryCode
     * @param int $numberOfDays
     *
     * @return mixed
     */
    public function fetchForecastByCityName($cityName, $countryCode = '', $numberOfDays = 16);

    /**
     * Call 16 day / daily forecast data by city id
     *
     * @param int $cityId
     * @param int $numberOfDays
     *
     * @return mixed
     */
    public function fetchForecastByCityId($cityId, $numberOfDays = 16);

    /**
     * Call 16 day / daily forecast data by geographic coordinates
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $numberOfDays
     *
     * @return mixed
     */
    public function fetchForecastByCityGeographicCoordinates($latitude, $longitude, $numberOfDays = 16);
}
