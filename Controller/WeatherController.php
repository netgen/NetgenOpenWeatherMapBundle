<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WeatherController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
 */
class WeatherController extends Controller
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
     * Returns weather data by geographic coordinates
     * 
     * @param float $latitude
     * @param float $longitude
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byGeographicCoordinates($latitude, $longitude)
    {
        $data = $this->weather->fetchWeatherDataByGeographicCoordinates($latitude, $longitude);

        return new Response($data);
    }

    /**
     * Returns weather data by city name
     *
     * @param string $cityName
     * @param string $countryCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byCityName($cityName, $countryCode = '')
    {
        $data = $this->weather->fetchWeatherDataByCityName($cityName, $countryCode);

        return new Response($data);
    }

    /**
     * Returns weather data by city id
     *
     * @param int $cityId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byCityId($cityId)
    {
        $data = $this->weather->fetchWeatherDataByCityId($cityId);

        return new Response($data);
    }

    /**
     * Returns weather data by zip code
     *
     * @param int $zipCode
     * @param string $countryCode
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byZipCode($zipCode, $countryCode = '')
    {
        $data = $this->weather->fetchWeatherDataByZipCode($zipCode, $countryCode);

        return new Response($data);
    }

    /**
     * Returns weather data for cities in rectangle zone
     *
     * @param float $longitudeLeft
     * @param float $latitudeBottom
     * @param float $logitudeRigth
     * @param float $latitudeTop
     * @param string $cluster
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function byRectangleZone($longitudeLeft, $latitudeBottom, $logitudeRigth, $latitudeTop, $cluster = 'yes')
    {
        $boundingBox = array($longitudeLeft, $latitudeBottom, $logitudeRigth, $latitudeTop);
        $data = $this->weather->fetchWeatherDataForCitiesWithinRectangleZone($boundingBox, $cluster);

        return new Response($data);
    }

    /**
     * Returns weather data for cities in circle
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
        $data = $this->weather->fetchWeatherDataForCitiesInCycle($latitude, $longitude, $cluster, $numberOfCities);

        return new Response($data);
    }

    /**
     * Returns weather data by several city ids
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

        $cities = $request->query->has('cities');
        $cities = explode(",", $cities);

        $data = $this->weather->fetchWeatherDataForSeveralCityIds($cities);

        return new Response($data);
    }
}
