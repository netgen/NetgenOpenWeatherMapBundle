<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface;
use Symfony\Component\HttpFoundation\Response;
use DateTime;

/**
 * Class AirPollutionController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
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
     * Returns ozone data
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

        $data = $this->airPollution->fetchOzoneData($latitude, $longitude, $datetime);

        return new Response($data);
    }

    /**
     * Returns carbon monoxide data
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

        $data = $this->airPollution->fetchCarbonMonoxideData($latitude, $longitude, $datetime);

        return new Response($data);
    }
}
