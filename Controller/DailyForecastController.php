<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
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
        $response = new Response();

        try {
            $data = $this->dailyForecast->fetchForecastByCityName($cityName, $countryCode, $numberOfDays);
            $response->setContent($data);
        } catch (NotAuthorizedException $e) {
            $response->setContent($e->getMessage());
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
        } catch (NotFoundException $e) {
            $response->setContent($e->getMessage());
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
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
        $response = new Response();

        try {
            $data = $this->dailyForecast->fetchForecastByCityId($cityId, $numberOfDays);
            $response->setContent($data);
        } catch (NotAuthorizedException $e) {
            $response->setContent($e->getMessage());
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
        } catch (NotFoundException $e) {
            $response->setContent($e->getMessage());
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
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
        $response = new Response();

        try {
            $data = $this->dailyForecast->fetchForecastByCityGeographicCoordinates($latitude, $longitude, $numberOfDays);
            $response->setContent($data);
        } catch (NotAuthorizedException $e) {
            $response->setContent($e->getMessage());
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
        } catch (NotFoundException $e) {
            $response->setContent($e->getMessage());
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}
