<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface DailyForecastInterface.
 */
interface DailyForecastInterface
{
    /**
     * Base URL for daily forecast.
     */
    const BASE_URL = 'http://api.openweathermap.org/data/2.5';

    /**
     * Call 16 day / daily forecast data by city name.
     *
     * @param string $cityName
     * @param string $countryCode
     * @param int $numberOfDays
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchForecastByCityName($cityName, $countryCode = '', $numberOfDays = 16);

    /**
     * Call 16 day / daily forecast data by city id.
     *
     * @param int $cityId
     * @param int $numberOfDays
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchForecastByCityId($cityId, $numberOfDays = 16);

    /**
     * Call 16 day / daily forecast data by geographic coordinates.
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $numberOfDays
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchForecastByCityGeographicCoordinates($latitude, $longitude, $numberOfDays = 16);
}
