<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Marek\OpenWeatherMap\API\Exception\APIException;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\CityId;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\CityName;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\DaysCount;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\Latitude;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\Longitude;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\ZipCode;
use Marek\OpenWeatherMap\API\Weather\Services\DailyForecastInterface;
use Symfony\Component\HttpFoundation\Response;

class DailyForecastController
{
    /**
     * @var \Marek\OpenWeatherMap\API\Weather\Services\DailyForecastInterface
     */
    protected $dailyForecast;

    /**
     * DailyForecastController constructor.
     *
     * @param \Marek\OpenWeatherMap\API\Weather\Services\DailyForecastInterface $dailyForecast
     */
    public function __construct(DailyForecastInterface $dailyForecast)
    {
        $this->dailyForecast = $dailyForecast;
    }

    /**
     * Returns daily forecast by city name.
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
        $city = new CityName($cityName, $countryCode);
        $days = new DaysCount($numberOfDays);

        try {
            $data = $this->dailyForecast->fetchForecastByCityName($city, $days);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }

    /**
     * Returns daily forecast by city id.
     *
     * @param int $cityId
     * @param int $numberOfDays
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByCityId($cityId, $numberOfDays = 16)
    {
        $response = new Response();
        $city = new CityId($cityId);
        $days = new DaysCount($numberOfDays);

        try {
            $data = $this->dailyForecast->fetchForecastByCityId($city, $days);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }

    /**
     * Returns daily forecast by geographic coordinates.
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
        $lat = new Latitude($latitude);
        $lng = new Longitude($longitude);
        $days = new DaysCount($numberOfDays);

        try {
            $data = $this->dailyForecast->fetchForecastByCityGeographicCoordinates($lat, $lng, $days);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }

    /**
     * Returns daily forecast by geographic coordinates.
     *
     * @param int $zipCode
     * @param int $numberOfDays
     * @param string $countryCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getForecastByZipCode($zipCode, $numberOfDays = 16, $countryCode = '')
    {
        $response = new Response();
        $zipCode = new ZipCode($zipCode, $countryCode);
        $days = new DaysCount($numberOfDays);

        try {
            $data = $this->dailyForecast->fetchForecastByZipCode($zipCode, $days);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }
}
