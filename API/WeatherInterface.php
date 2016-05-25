<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API;

/**
 * Interface WeatherInterface
 * @package Netgen\Bundle\OpenWeatherMapBundle\API
 */
interface WeatherInterface
{
    /**
     * Call current weather data for one location by city name
     *
     * @param $cityName
     * @param $countryCode
     * @param string $units
     * @param string $language
     *
     * @return mixed
     */
    public function fetchWeatherDataByCityName($cityName, $countryCode, $units = 'metric', $language= 'en');

    /**
     * Call current weather data for one location by city id
     *
     * @param int $cityId
     * @param string $units
     * @param string $language
     *
     * @return mixed
     */
    public function fetchWeatherDataByCityId($cityId, $units = 'metric', $language= 'en');

    /**
     * Call current weather data for one location by geographic coordinates
     *
     * @param int $latitude
     * @param int $longitude
     * @param string $units
     * @param string $language
     *
     * @return mixed
     */
    public function fetchWeatherDataByGeographicCoordinates($latitude, $longitude, $units = 'metric', $language= 'en');


    /**
     * Call current weather data for one location by zip code
     *
     * @param int $zipCode
     * @param string $countryCode
     * @param string $units
     * @param string $language
     *
     * @return mixed
     */
    public function fetchWeatherDataByZipId($zipCode, $countryCode, $units = 'metric', $language= 'en');
}
