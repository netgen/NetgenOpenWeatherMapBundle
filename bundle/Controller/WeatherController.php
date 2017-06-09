<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Marek\OpenWeatherMap\API\Exception\APIException;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\BoundingBox;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\CityCount;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\CityId;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\CityIds;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\CityName;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\Cluster;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\Latitude;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\Longitude;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\ZipCode;
use Marek\OpenWeatherMap\API\Weather\Services\WeatherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WeatherController
{
    /**
     * @var \Marek\OpenWeatherMap\API\Weather\Services\WeatherInterface
     */
    protected $weather;

    /**
     * WeatherController constructor.
     *
     * @param \Marek\OpenWeatherMap\API\Weather\Services\WeatherInterface $weather
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
        $lat = new Latitude($latitude);
        $lng = new Longitude($longitude);

        try {
            $data = $this->weather->byGeographicCoordinates($lat, $lng);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
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
        $city = new CityName($cityName, $countryCode);

        try {
            $data = $this->weather->byCityName($city);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
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
        $city = new CityId($cityId);

        try {
            $data = $this->weather->byCityId($city);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
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
        $zip = new ZipCode($zipCode, $countryCode);

        try {
            $data = $this->weather->byZipCode($zip);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
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
        $response = new Response();
        $boundingBox = new BoundingBox($longitudeLeft, $latitudeBottom, $longitudeRight, $latitudeTop, $mapZoom);
        $cluster = new Cluster($cluster);

        try {
            $data = $this->weather->withinARectangleZone($boundingBox, $cluster);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
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
        $latitude = new Latitude($latitude);
        $longitude = new Longitude($longitude);
        $cluster = new Cluster($cluster);
        $numberOfCities = new CityCount($numberOfCities);

        try {
            $data = $this->weather->inCycle($latitude, $longitude, $cluster, $numberOfCities);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
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

        $ids = array_map(
            function($id) {
                return new CityId($id);
            },
            $cities
        );

        $cities = new CityIds($ids);

        try {
            $data = $this->weather->severalCityIds($cities);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }
}
