<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
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
        $response = new Response();

        try {
            $data = $this->hourForecast->fetchForecastByCityName($cityName, $countryCode);
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
     * Returns hour forecast by city id
     *
     * @param int $cityId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityId($cityId)
    {
        $response = new Response();

        try {
            $data = $this->hourForecast->fetchForecastByCityId($cityId);
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
     * Returns hour forecast by geographic coordinates
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityGeographicCoordinates($latitude, $longitude)
    {
        $response = new Response();

        try {
            $data = $this->hourForecast->fetchForecastByCityGeographicCoordinates($latitude, $longitude);
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
