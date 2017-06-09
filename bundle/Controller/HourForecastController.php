<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Marek\OpenWeatherMap\API\Exception\APIException;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\CityId;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\CityName;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\Latitude;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\Longitude;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\ZipCode;
use Marek\OpenWeatherMap\API\Weather\Services\HourForecastInterface;
use Symfony\Component\HttpFoundation\Response;

class HourForecastController
{
    /**
     * @var \Marek\OpenWeatherMap\API\Weather\Services\HourForecastInterface
     */
    protected $hourForecast;

    /**
     * HourForecastController constructor.
     *
     * @param \Marek\OpenWeatherMap\API\Weather\Services\HourForecastInterface $hourForecast
     */
    public function __construct(HourForecastInterface $hourForecast)
    {
        $this->hourForecast = $hourForecast;
    }

    /**
     * Returns hour forecast by city name.
     *
     * @param string $cityName
     * @param string $countryCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityName($cityName, $countryCode = '')
    {
        $response = new Response();
        $city = new CityName($cityName, $countryCode);

        try {
            $data = $this->hourForecast->fetchForecastByCityName($city);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }

    /**
     * Returns hour forecast by city id.
     *
     * @param int $cityId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityId($cityId)
    {
        $response = new Response();
        $city = new CityId($cityId);

        try {
            $data = $this->hourForecast->fetchForecastByCityId($city);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }

    /**
     * Returns hour forecast by geographic coordinates.
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityGeographicCoordinates($latitude, $longitude)
    {
        $response = new Response();
        $lat = new Latitude($latitude);
        $lng = new Longitude($longitude);

        try {
            $data = $this->hourForecast->fetchForecastByCityGeographicCoordinates($lat, $lng);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }

    /**
     * Returns hour forecast by zip code.
     *
     * @param int $zipCode
     * @param string $countryCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByZipCode($zipCode, $countryCode = '')
    {
        $response = new Response();
        $zip = new ZipCode($zipCode, $countryCode);

        try {
            $data = $this->hourForecast->fetchForecastByZipCode($zip);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }
}
