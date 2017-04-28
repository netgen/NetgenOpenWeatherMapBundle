<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WeatherController.
 */
class WeatherController
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface
     */
    protected $weather;

    /**
     * WeatherController constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface $weather
     */
    public function __construct(WeatherInterface $weather)
    {
        $this->weather = $weather;
    }

    /**
     * Returns weather data by geographic coordinates.
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byGeographicCoordinates($latitude, $longitude)
    {
        $response = new Response();

        try {
            $data = $this->weather->fetchWeatherDataByGeographicCoordinates($latitude, $longitude);
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
     * Returns weather data by city name.
     *
     * @param string $cityName
     * @param string $countryCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byCityName($cityName, $countryCode = '')
    {
        $response = new Response();

        try {
            $data = $this->weather->fetchWeatherDataByCityName($cityName, $countryCode);
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
     * Returns weather data by city id.
     *
     * @param int $cityId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byCityId($cityId)
    {
        $response = new Response();

        try {
            $data = $this->weather->fetchWeatherDataByCityId($cityId);
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
     * Returns weather data by zip code.
     *
     * @param int $zipCode
     * @param string $countryCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byZipCode($zipCode, $countryCode = '')
    {
        $response = new Response();

        try {
            $data = $this->weather->fetchWeatherDataByZipCode($zipCode, $countryCode);
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
     * Returns weather data for cities in rectangle zone.
     *
     * @param float $longitudeLeft
     * @param float $latitudeBottom
     * @param float $longitudeRight
     * @param float $latitudeTop
     * @param int $mapZoom
     * @param string $cluster
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byRectangleZone($longitudeLeft, $latitudeBottom, $longitudeRight, $latitudeTop, $mapZoom = 10, $cluster = 'yes')
    {
        $boundingBox = array($longitudeLeft, $latitudeBottom, $longitudeRight, $latitudeTop, $mapZoom);

        $response = new Response();

        try {
            $data = $this->weather->fetchWeatherDataForCitiesWithinRectangleZone($boundingBox, $cluster);
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
     * Returns weather data for cities in circle.
     *
     * @param float $latitude
     * @param float $longitude
     * @param string $cluster
     * @param int $numberOfCities
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byCircle($latitude, $longitude, $cluster = 'yes', $numberOfCities = 10)
    {
        $response = new Response();

        try {
            $data = $this->weather->fetchWeatherDataForCitiesInCycle($latitude, $longitude, $cluster, $numberOfCities);
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
     * Returns weather data by several city ids.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byCityIds(Request $request)
    {
        $response = new Response();
        if (!$request->query->has('cities')) {
            return $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $cities = $request->query->get('cities');
        $cities = explode(',', $cities);

        try {
            $data = $this->weather->fetchWeatherDataForSeveralCityIds($cities);
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
