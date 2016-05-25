<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Service;

use Netgen\Bundle\OpenWeatherMapBundle\API\WeatherInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Tedivm\StashBundle\Service\CacheService;

/**
 * Class Weather
 * @package Netgen\Bundle\OpenWeatherMapBundle\Service
 */
class Weather implements WeatherInterface
{
    /**
     * @var \Tedivm\StashBundle\Service\CacheService
     */
    protected $cacheService;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $imageUrl;

    /**
     * @var string
     */
    protected $imageLocation;

    /**
     * Weather constructor.
     *
     * @param string $apiKey
     * @param string $url
     * @param string $imageUrl
     * @param \Tedivm\StashBundle\Service\CacheService $cacheService
     * @param string $imageLocation
     */
    public function __construct($apiKey, $url, $imageUrl, CacheService $cacheService, $imageLocation)
    {
        $this->cacheService = $cacheService;
        $this->apiKey = $apiKey;
        $this->url = $url;
        $this->imageUrl = $imageUrl;
        $this->imageLocation = $imageLocation;
    }


    /**
     * Proxy to the remote image fetch. Also caches the image
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getImageFileById($id)
    {
        $apiCallUrl = $this->imageUrl . $id;

        if (!is_dir($this->imageLocation)) {
            mkdir($this->imageLocation);
        }

        // if the image does not exist, or it is more than 1 day old, overwrite it
        if (
            ($image = @file_get_contents($this->getImagePath($id)) === false)
            ||
            date("d", filemtime($this->getImagePath($id))) !== date('d')
        ){
            file_put_contents($this->getImagePath($id), $this->curlToUrl($apiCallUrl));
        }

        return new BinaryFileResponse($this->getImagePath($id));
    }

    /**
     * Returns a response from a remote URL using common CURL settings
     *
     * Used as a proxy to avoid plain HTTP calls on the page in favor of HTTPS
     *
     * @param string $url
     *
     * @return mixed
     */
    public function curlToUrl($url)
    {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($curlHandle);
        curl_close($curlHandle);

        return $response;
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByGeographicCoordinates($latitude, $longitude, $units = 'metric', $language = 'en')
    {
        $queryPart = 'lat=' . $latitude . '&lon=' . $longitude . '&units=' . $units . '&lang=' . $language . '&appid=' . $this->apiKey;

        $url = $this->url . $queryPart;
        $urlHash = md5($url);

        $currentItem = $this->cacheService->getItem('netgen_openweather_map', 'weather', $urlHash);

        if ($currentItem->isMiss()) {
            $response = $this->curlToUrl($url);
            $currentItem->set($response, new \DateTime('+1 hour'));

            return $response;
        } else {
            return $currentItem->get();
        }
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByCityName($cityName, $countryCode, $units = 'metric', $language = 'en')
    {
        throw new \RuntimeException('Not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByCityId($cityId, $units = 'metric', $language = 'en')
    {
        throw new \RuntimeException('Not implemented.');
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByZipId($zipCode, $countryCode, $units = 'metric', $language = 'en')
    {
        throw new \RuntimeException('Not implemented.');
    }

    /**
     * @param $id
     *
     * @return string
     */
    private function getImagePath($id)
    {
        return $this->imageLocation . "/{$id}.png";
    }
}
