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
     * @var
     */
    protected $apiKey;

    /**
     * @var
     */
    protected $url;

    /**
     * @var
     */
    protected $units;

    /**
     * @var
     */
    protected $language;

    /**
     * @var
     */
    protected $mode;

    /**
     * @var
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
     * @param string $url
     * @param string $units
     * @param string $language
     * @param string $mode
     * @param string $type
     * @param \Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface $cacheService
     * @param int $ttl
     */
    public function __construct(HttpClientInterface $client, $apiKey, $url, $units, $language, $mode, $type, HandlerInterface $cacheService, $ttl)
    {
        $this->apiKey = $apiKey;
        $this->url = $url;
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

        $url = $this->url . $queryPart;

        $hash = md5($url);

        if ($this->cacheService->has($hash)) {

            return $this->cacheService->get($hash);

        } else {

            $result = $this->client->get($url);

            $this->cacheService->set($hash, $result, $this->ttl);

            return $result;

        }
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByCityId($cityId)
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByGeographicCoordinates($latitude, $longitude)
    {
        $queryPart = '/weather?lat=' . $latitude . '&lon=' . $longitude . $this->getParams();

        $url = $this->url . $queryPart;
        dump($url);

        $hash = md5($url);

        if ($this->cacheService->has($hash)) {

            return $this->cacheService->get($hash);

        } else {

            $result = $this->client->get($url);

            $this->cacheService->set($hash, $result, $this->ttl);

            return $result;

        }
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByZipId($zipCode, $countryCode = '')
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataForCitiesWithinRectangleZone(array $boundingBox, $cluster = 'yes')
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataForCitiesInCycle($latitude, $longitude, $cluster = 'yes', $numberOfCities = 10)
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataForSeveralCityIds(array $cities)
    {
        throw new \RuntimeException('Not implemented');
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
}
