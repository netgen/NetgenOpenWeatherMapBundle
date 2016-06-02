<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\UltravioletIndexInterface;
use Symfony\Component\HttpFoundation\Response;
use DateTime;

/**
 * Class UltravioletIndexController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
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
     * Returns ultraviolet index
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

        $data = $this->ultravioletIndex->fetchUltraviletIndex($latitude, $longitude, $datetime);

        return new Response($data);
    }
}
