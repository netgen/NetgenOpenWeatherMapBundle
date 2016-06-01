<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DailyForecastController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
 */
class DailyForecastController extends Controller
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface
     */
    protected $dailyForecast;

    /**
     * DailyForecastController constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface $dailyForecast
     */
    public function __construct(DailyForecastInterface $dailyForecast)
    {
        $this->dailyForecast = $dailyForecast;
    }
}
