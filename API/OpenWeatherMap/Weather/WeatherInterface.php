<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface WeatherInterface
 * @package Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeather\Weather
 */
interface WeatherInterface
{
    /**
     * Call current weather data for one location by city name
     *
     * @param string $cityName
     * @param string $countryCode
     *
     * @return mixed
     */
    public function fetchWeatherDataByCityName($cityName, $countryCode = '');

    /**
     * Call current weather data for one location by city id
     *
     * @param int $cityId
     *
     * @return mixed
     */
    public function fetchWeatherDataByCityId($cityId);

    /**
     * Call current weather data for one location by geographic coordinates
     *
     * @param int $latitude
     * @param int $longitude
     *
     * @return mixed
     */
    public function fetchWeatherDataByGeographicCoordinates($latitude, $longitude);


    /**
     * Call current weather data for one location by zip code
     *
     * @param int $zipCode
     * @param string $countryCode
     *
     * @return mixed
     */
    public function fetchWeatherDataByZipCode($zipCode, $countryCode = '');

    /**
     * Call current weather data for several cities within a rectangle zone
     *
     * @param array $boundingBox Longitude-left,latitude-bottom,longitude-right,latitude-top
     * @param string $cluster
     *
     * @return mixed
     */
    public function fetchWeatherDataForCitiesWithinRectangleZone(array $boundingBox, $cluster = 'yes');

    /**
     * Call current weather data for several cities in cycle
     *
     * @param string $latitude
     * @param string $longitude
     * @param string $cluster
     * @param int $numberOfCities
     *
     * @return mixed
     */
    public function fetchWeatherDataForCitiesInCycle($latitude, $longitude, $cluster = 'yes', $numberOfCities = 10);

    /**
     * Call current weather data for several cities by city IDs
     *
     * @param array $cities
     *
     * @return mixed
     */
    public function fetchWeatherDataForSeveralCityIds(array $cities);
}
