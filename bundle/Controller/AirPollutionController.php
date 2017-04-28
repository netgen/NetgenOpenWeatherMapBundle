<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use DateTime;
use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AirPollutionController.
 */
class AirPollutionController
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface
     */
    protected $airPollution;

    /**
     * AirPollutionController constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface $airPollution
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
        if ($datetime !== 'current') {
            $datetime = DateTime::createFromFormat('c', $datetime);

            if ($datetime === false) {
                $datetime = 'current';
            }
        }

        $response = new Response();

        try {
            $data = $this->airPollution->fetchOzoneData($latitude, $longitude, $datetime);
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
        if ($datetime !== 'current') {
            $datetime = DateTime::createFromFormat('c', $datetime);

            if ($datetime === false) {
                $datetime = 'current';
            }
        }

        $response = new Response();

        try {
            $data = $this->airPollution->fetchCarbonMonoxideData($latitude, $longitude, $datetime);
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
