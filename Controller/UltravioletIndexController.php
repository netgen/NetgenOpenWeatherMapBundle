<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\UltravioletIndexInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Response;
use DateTime;

/**
 * Class UltravioletIndexController.
 */
class UltravioletIndexController
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\UltravioletIndexInterface
     */
    protected $ultravioletIndex;

    /**
     * UltravioletIndexController constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\UltravioletIndexInterface $ultravioletIndex
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
        if ($datetime !== 'current') {
            $datetime = DateTime::createFromFormat('c', $datetime);

            if ($datetime === false) {
                $datetime = 'current';
            }
        }

        $response = new Response();

        try {
            $data = $this->ultravioletIndex->fetchUltraviletIndex($latitude, $longitude, $datetime);
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
