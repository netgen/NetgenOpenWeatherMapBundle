<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class HourForecastController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
 */
class HourForecastController extends Controller
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface
     */
    protected $hourForecast;

    /**
     * HourForecastController constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface $hourForecast
     */
    public function __construct(HourForecastInterface $hourForecast)
    {
        $this->hourForecast = $hourForecast;
    }
}
