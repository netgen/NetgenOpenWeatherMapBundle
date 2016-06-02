<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface HourForecastInterface
 * @package Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather
 */
interface HourForecastInterface
{
    /**
     * Base URL for hour forecast
     */
    const BASE_URL = 'http://api.openweathermap.org/data/2.5';

    /**
     * Call 5 day / 3 hour forecast data by city name
     *
     * @param string $cityName
     * @param string $countryCode
     *
     * @return string
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     */
    public function fetchForecastByCityName($cityName, $countryCode = '');

    /**
     * Call 5 day / 3 hour forecast data by city id
     *
     * @param int $cityId
     *
     * @return string
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     */
    public function fetchForecastByCityId($cityId);

    /**
     * Call 5 day / 3 hour forecast data by geographic coordinates
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @return string
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     */
    public function fetchForecastByCityGeographicCoordinates($latitude, $longitude);
}
