<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface UltravioletIndexInterface
 * @package Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather
 */
interface UltravioletIndexInterface
{
    /**
     * Base URL for ultraviolet index
     */
    const BASE_URL = 'http://api.openweathermap.org/v3/uvi';

    /**
     * Fetch Ultraviolet index by geographic coordinates
     *
     * @param float $latitude
     * @param float $longitude
     * @param \Datetime|string $datetime
     *
     * @return string
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     */
    public function fetchUltraviletIndex($latitude, $longitude, $datetime = 'current');
}
