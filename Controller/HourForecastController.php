<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HourForecastController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
 */
class HourForecastController
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface
     */
    protected $hourForecast;

    /**
     * HourForecastController constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface $hourForecast
     */
    public function __construct(HourForecastInterface $hourForecast)
    {
        $this->hourForecast = $hourForecast;
    }

    /**
     * Returns hour forecast by city name
     *
     * @param string $cityName
     * @param string $countryCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityName($cityName, $countryCode = '')
    {
        $data = $this->hourForecast->fetchForecastByCityName($cityName, $countryCode);

        return new Response($data);
    }

    /**
     * Returns hour forecast by city id
     *
     * @param int $cityId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityId($cityId)
    {
        $data = $this->hourForecast->fetchForecastByCityId($cityId);

        return new Response($data);
    }

    /**
     * Returns hour forecast by geographic coordinates
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityGeographicCoordinates($latitude, $longitude)
    {
        $data = $this->hourForecast->fetchForecastByCityName($latitude, $longitude);

        return new Response($data);
    }
}
