<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface HourForecastInterface.
 */
interface HourForecastInterface
{
    /**
     * Base URL for hour forecast.
     */
    const BASE_URL = 'http://api.openweathermap.org/data/2.5';

    /**
     * Call 5 day / 3 hour forecast data by city name.
     *
     * @param string $cityName
     * @param string $countryCode
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchForecastByCityName($cityName, $countryCode = '');

    /**
     * Call 5 day / 3 hour forecast data by city id.
     *
     * @param int $cityId
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchForecastByCityId($cityId);

    /**
     * Call 5 day / 3 hour forecast data by geographic coordinates.
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchForecastByCityGeographicCoordinates($latitude, $longitude);
}
