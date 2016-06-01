<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class WeatherStationsController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
 */
class WeatherStationsController extends Controller
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
}
