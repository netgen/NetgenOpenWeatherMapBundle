<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Marek\OpenWeatherMap\API\Exception\APIException;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\DateTime;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\GeographicCoordinates;
use Marek\OpenWeatherMap\API\Weather\Services\AirPollutionInterface;
use Symfony\Component\HttpFoundation\Response;

class AirPollutionController
{
    /**
     * @var \Marek\OpenWeatherMap\API\Weather\Services\AirPollutionInterface
     */
    protected $airPollution;

    /**
     * AirPollutionController constructor.
     *
     * @param \Marek\OpenWeatherMap\API\Weather\Services\AirPollutionInterface $airPollution
     */
    public function __construct(AirPollutionInterface $airPollution)
    {
        $this->airPollution = $airPollution;
    }

    /**
     * Returns ozone data.
     *
     * @param float $latitude
     * @param float $longitude
     * @param string $datetime ISO 8601 date string
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getOzoneData($latitude, $longitude, $datetime = 'current')
    {
        $response = new Response();
        $geographicCoordinated = new GeographicCoordinates($latitude, $longitude);
        $dateTime = new DateTime($datetime);

        try {
            $data = $this->airPollution->fetchOzoneData($geographicCoordinated, $dateTime);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }

    /**
     * Returns carbon monoxide data.
     *
     * @param float $latitude
     * @param float $longitude
     * @param string $datetime ISO 8601 date string
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCarbonMonoxideData($latitude, $longitude, $datetime = 'current')
    {
        $response = new Response();
        $geographicCoordinated = new GeographicCoordinates($latitude, $longitude);
        $dateTime = new DateTime($datetime);

        try {
            $data = $this->airPollution->fetchCarbonMonoxideData($geographicCoordinated, $dateTime);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }

    /**
     * Returns sulfur dioxide data.
     *
     * @param float $latitude
     * @param float $longitude
     * @param string $datetime ISO 8601 date string
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getSulfurDioxideData($latitude, $longitude, $datetime = 'current')
    {
        $response = new Response();
        $geographicCoordinated = new GeographicCoordinates($latitude, $longitude);
        $dateTime = new DateTime($datetime);

        try {
            $data = $this->airPollution->fetchSulfurDioxideData($geographicCoordinated, $dateTime);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }

    /**
     * Returns nitrogen dioxide data.
     *
     * @param float $latitude
     * @param float $longitude
     * @param string $datetime ISO 8601 date string
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getNitrogenDioxideData($latitude, $longitude, $datetime = 'current')
    {
        $response = new Response();
        $geographicCoordinated = new GeographicCoordinates($latitude, $longitude);
        $dateTime = new DateTime($datetime);

        try {
            $data = $this->airPollution->fetchNitrogenDioxideData($geographicCoordinated, $dateTime);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }
}
