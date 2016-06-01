<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class AirPollutionController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
 */
class AirPollutionController extends Controller
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
}
