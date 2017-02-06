<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface WeatherInterface.
 */
interface WeatherInterface
{
    /**
     * Base URL for weather.
     */
    const BASE_URL = 'http://api.openweathermap.org/data/2.5';

    /**
     * Call current weather data for one location by city name.
     *
     * @param string $cityName
     * @param string $countryCode
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchWeatherDataByCityName($cityName, $countryCode = '');

    /**
     * Call current weather data for one location by city id.
     *
     * @param int $cityId
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchWeatherDataByCityId($cityId);

    /**
     * Call current weather data for one location by geographic coordinates.
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchWeatherDataByGeographicCoordinates($latitude, $longitude);

    /**
     * Call current weather data for one location by zip code.
     *
     * @param int $zipCode
     * @param string $countryCode
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchWeatherDataByZipCode($zipCode, $countryCode = '');

    /**
     * Call current weather data for several cities within a rectangle zone.
     *
     * @param array $boundingBox Longitude-left,latitude-bottom,longitude-right,latitude-top, map zoom
     * @param string $cluster
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchWeatherDataForCitiesWithinRectangleZone(array $boundingBox, $cluster = 'yes');

    /**
     * Call current weather data for several cities in cycle.
     *
     * @param string $latitude
     * @param string $longitude
     * @param string $cluster
     * @param int $numberOfCities
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchWeatherDataForCitiesInCycle($latitude, $longitude, $cluster = 'yes', $numberOfCities = 10);

    /**
     * Call current weather data for several cities by city IDs.
     *
     * @param array $cities
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchWeatherDataForSeveralCityIds(array $cities);
}
