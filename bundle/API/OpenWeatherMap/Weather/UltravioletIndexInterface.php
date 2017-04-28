<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather;

/**
 * Interface UltravioletIndexInterface.
 */
interface UltravioletIndexInterface
{
    /**
     * Base URL for ultraviolet index.
     */
    const BASE_URL = 'http://api.openweathermap.org/v3/uvi';

    /**
     * Fetch Ultraviolet index by geographic coordinates.
     *
     * @param float $latitude
     * @param float $longitude
     * @param \Datetime|string $datetime
     *
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     * @throws \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     *
     * @return string
     */
    public function fetchUltravioletIndex($latitude, $longitude, $datetime = 'current');
}
