<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface;
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
        $data = $this->weatherStations->fetchFromOnStationById($stationId);

        return new Response($data);
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

        $data = $this->weatherStations->fetchFromSeveralByRectangleZone($boundingBox, $cluster, $numberOfStations);

        return new Response($data);
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
        $data = $this->weatherStations->fetchFromSeveralByGeoPoint($latitude, $longitude, $numberOfStations);

        return new Response($data);
    }
}
