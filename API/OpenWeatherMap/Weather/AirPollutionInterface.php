<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface AirPollutionInterface
 * @package Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather
 */
interface AirPollutionInterface
{
    /**
     * Base URL for air pollution
     */
    const BASE_URL = 'http://api.openweathermap.org/pollution/v1';

    /**
     * Fetch Ozone Data by geographic coordinates
     *
     * @param float $latitude
     * @param float $longitude
     * @param \DateTime|string $datetime
     *
     * @return string
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     */
    public function fetchOzoneData($latitude, $longitude, $datetime = 'current');

    /**
     * Fetch Carbon Monoxide Data by geographic coordinates
     *
     * @param float $latitude
     * @param float $longitude
     * @param \DateTime|string $datetime
     *
     * @return string
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     */
    public function fetchCarbonMonoxideData($latitude, $longitude, $datetime = 'current');
}
