<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WeatherStationsController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
 */
class WeatherStationsController
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface
     */
    protected $weatherStations;

    /**
     * WeatherStationsController constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface $weatherStations
     */
    public function __construct(WeatherStationsInterface $weatherStations)
    {
        $this->weatherStations = $weatherStations;
    }

    /**
     * Returns data from one stations by station id
     *
     * @param int $stationId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFromOnStationById($stationId)
    {
        $response = new Response();

        try {
            $data = $this->weatherStations->fetchFromOnStationById($stationId);
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
     * Returns data from several stations by rectangle zone
     *
     * @param float $longitudeTopLeft
     * @param float $latitudeTopLeft
     * @param float $longitudeBottomRight
     * @param float $latitudeBottomRight
     * @param int $mapZoom
     * @param string $cluster
     * @param int $numberOfStations
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFromSeveralByRectangleZone($longitudeTopLeft, $latitudeTopLeft, $longitudeBottomRight, $latitudeBottomRight, $mapZoom, $cluster = 'yes', $numberOfStations = 10)
    {
        $boundingBox = array(
            $longitudeTopLeft, $latitudeTopLeft, $longitudeBottomRight, $latitudeBottomRight, $mapZoom
        );

        $response = new Response();

        try {
            $data = $this->weatherStations->fetchFromSeveralByRectangleZone($boundingBox, $cluster, $numberOfStations);
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
     * Returns data from several stations by geo point
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $numberOfStations
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFromSeveralByGeoPoint($latitude, $longitude, $numberOfStations = 10)
    {
        $response = new Response();

        try {
            $data = $this->weatherStations->fetchFromSeveralByGeoPoint($latitude, $longitude, $numberOfStations);
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
