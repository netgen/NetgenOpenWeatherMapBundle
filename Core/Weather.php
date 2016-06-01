<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;

/**
 * Class Weather
 * @package Netgen\Bundle\OpenWeatherMapBundle\Core
 */
class Weather implements WeatherInterface
{
    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface
     */
    protected $cacheService;

    /**
     * @var int
     */
    protected $ttl;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $units;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $mode;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var \Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface
     */
    protected $client;

    /**
     * Weather constructor.
     *
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface $client
     * @param string $apiKey
     * @param string $units
     * @param string $language
     * @param string $mode
     * @param string $type
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface $cacheService
     * @param int $ttl
     */
    public function __construct(HttpClientInterface $client, $apiKey, $units, $language, $mode, $type, HandlerInterface $cacheService, $ttl)
    {
        $this->apiKey = $apiKey;
        $this->units = $units;
        $this->language = $language;
        $this->mode = $mode;
        $this->type = $type;
        $this->cacheService = $cacheService;
        $this->ttl = $ttl;
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByCityName($cityName, $countryCode = '')
    {
        if (empty($countryCode)) {
            $queryPart = '/weather?q=' . $cityName;
        } else {
            $queryPart = '/weather?q=' . $cityName . ',' . $countryCode;
        }

        $queryPart = $queryPart . $this->getParams();

        return $this->getResult($queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByCityId($cityId)
    {
        $queryPart = '/weather?id=' . $cityId . $this->getParams();

        return $this->getResult($queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByGeographicCoordinates($latitude, $longitude)
    {
        $queryPart = '/weather?lat=' . $latitude . '&lon=' . $longitude . $this->getParams();

        return $this->getResult($queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByZipCode($zipCode, $countryCode = '')
    {
        if (empty($countryCode)) {
            $queryPart = '/weather?zip=' . $zipCode;
        } else {
            $queryPart = '/weather?zip=' . $zipCode . ',' . $countryCode;
        }

        $queryPart = $queryPart . $this->getParams();

        return $this->getResult($queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataForCitiesWithinRectangleZone(array $boundingBox, $cluster = 'yes')
    {
        $queryPart = '/box/city?bbox=' . implode(',', $boundingBox) . '&cluster' . $cluster . $this->getParams();

        return $this->getResult($queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataForCitiesInCycle($latitude, $longitude, $cluster = 'yes', $numberOfCities = 10)
    {
        $queryPart = '/find?lat=' . $latitude
            . '&lon=' . $longitude
            . '&cluster=' . $cluster
            . '&cnt=' . $numberOfCities . $this->getParams();

        return $this->getResult($queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataForSeveralCityIds(array $cities)
    {
        $queryPart = '/group?id=' . implode(',', $cities) . $this->getParams();

        return $this->getResult($queryPart);
    }

    /**
     * Return standard params
     *
     * @return string
     */
    protected function getParams()
    {
        return '&units=' . $this->units . '&lang=' . $this->language
        . '&mode=' . $this->mode . '&type=' . $this->type
        . '&appid=' . $this->apiKey;
    }

    /**
     * Helper method
     *
     * @param string $queryPart
     *
     * @return mixed
     */
    protected function getResult($queryPart)
    {
        $url = self::BASE_URL . $queryPart;

        $hash = md5($url);

        if ($this->cacheService->has($hash)) {

            return $this->cacheService->get($hash);

        } else {

            $result = $this->client->get($url);

            $this->cacheService->set($hash, $result, $this->ttl);

            return $result;

        }
    }
}
