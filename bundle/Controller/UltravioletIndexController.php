<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Marek\OpenWeatherMap\API\Exception\APIException;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\DateTime;
use Marek\OpenWeatherMap\API\Value\Parameter\Input\GeographicCoordinates;
use Marek\OpenWeatherMap\API\Weather\Services\UltravioletIndexInterface;
use Symfony\Component\HttpFoundation\Response;

class UltravioletIndexController
{
    /**
     * @var \Marek\OpenWeatherMap\API\Weather\Services\UltravioletIndexInterface
     */
    protected $ultravioletIndex;

    /**
     * UltravioletIndexController constructor.
     *
     * @param \Marek\OpenWeatherMap\API\Weather\Services\UltravioletIndexInterface $ultravioletIndex
     */
    public function __construct(UltravioletIndexInterface $ultravioletIndex)
    {
        $this->ultravioletIndex = $ultravioletIndex;
    }

    /**
     * Returns ultraviolet index.
     *
     * @param float $latitude
     * @param float $longitude
     * @param string $datetime ISO 8601 date string
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUltravioletIndex($latitude, $longitude, $datetime = 'current')
    {
        $response = new Response();

        $geographicCoordinates = new GeographicCoordinates($latitude, $longitude);
        $dateTime = new DateTime($datetime);

        try {
            $data = $this->ultravioletIndex->fetchUltravioletIndex($geographicCoordinates, $dateTime);
            $response->setContent($data);
        } catch (APIException $e) {
            $response->setContent($e->getAPIMessage());
            $response->setStatusCode($e->getStatusCode());
        }

        return $response;
    }
}
