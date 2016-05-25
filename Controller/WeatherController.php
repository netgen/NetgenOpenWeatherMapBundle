<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\API\WeatherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WeatherController
 * @package Netgen\Bundle\OpenWeatherMapBundle\Controller
 */
class WeatherController extends Controller
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\API\WeatherInterface
     */
    private $weather;

    /**
     * WeatherController constructor.
     * @param \Netgen\Bundle\OpenWeatherMapBundle\API\WeatherInterface $weather
     */
    public function __construct(WeatherInterface $weather)
    {
        $this->weather = $weather;
    }

    /**
     * Returns weather data
     * 
     * @param $latitude
     * @param $longitude
     * @param $units
     * @param $language
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getWeatherAction($latitude, $longitude, $units = 'metric', $language = 'en')
    {
        $data = $this->weather->fetchWeatherDataByGeographicCoordinates($latitude, $longitude, $units, $language);
        
        return new Response($data);
    }
}
