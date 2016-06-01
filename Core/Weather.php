<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface;

/**
 * Class Weather
 * @package Netgen\Bundle\OpenWeatherMapBundle\Core
 */
class Weather extends WeatherBase implements WeatherInterface
{
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

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByCityId($cityId)
    {
        $queryPart = '/weather?id=' . $cityId . $this->getParams();

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataByGeographicCoordinates($latitude, $longitude)
    {
        $queryPart = '/weather?lat=' . $latitude . '&lon=' . $longitude . $this->getParams();

        return $this->getResult(self::BASE_URL, $queryPart);
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

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataForCitiesWithinRectangleZone(array $boundingBox, $cluster = 'yes')
    {
        $queryPart = '/box/city?bbox=' . implode(',', $boundingBox) . '&cluster=' . $cluster . $this->getParams();

        return $this->getResult(self::BASE_URL, $queryPart);
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

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchWeatherDataForSeveralCityIds(array $cities)
    {
        $queryPart = '/group?id=' . implode(',', $cities) . $this->getParams();

        return $this->getResult(self::BASE_URL, $queryPart);
    }
}
