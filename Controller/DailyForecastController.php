<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DailyForecastController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
 */
class DailyForecastController
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface
     */
    protected $dailyForecast;

    /**
     * DailyForecastController constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface $dailyForecast
     */
    public function __construct(DailyForecastInterface $dailyForecast)
    {
        $this->dailyForecast = $dailyForecast;
    }

    /**
     * Returns daily forecast by city name
     *
     * @param string $cityName
     * @param int $numberOfDays
     * @param string $countryCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityName($cityName, $numberOfDays = 16, $countryCode = '')
    {
        $data = $this->dailyForecast->fetchForecastByCityName($cityName, $countryCode, $numberOfDays);

        return new Response($data);
    }

    /**
     * Returns daily forecast by city id
     *
     * @param int $cityId
     * @param int $numberOfDays
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityId($cityId, $numberOfDays = 16)
    {
        $data = $this->dailyForecast->fetchForecastByCityId($cityId, $numberOfDays);

        return new Response($data);
    }

    /**
     * Returns daily forecast by geographic coordinates
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $numberOfDays
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityGeographicCoordinates($latitude, $longitude, $numberOfDays = 16)
    {
        $data = $this->dailyForecast->fetchForecastByCityGeographicCoordinates($latitude, $longitude, $numberOfDays);

        return new Response($data);
    }
}
