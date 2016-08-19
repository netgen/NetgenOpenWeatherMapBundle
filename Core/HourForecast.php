<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface;

/**
 * Class HourForecast.
 */
class HourForecast extends WeatherBase implements HourForecastInterface
{
    /**
     * {@inheritdoc}
     */
    public function fetchForecastByCityName($cityName, $countryCode = '')
    {
        if (empty($countryCode)) {
            $queryPart = '/forecast?q=' . $cityName;
        } else {
            $queryPart = '/forecast?q=' . $cityName . ',' . $countryCode;
        }

        $queryPart = $queryPart . $this->getParams();

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * {@inheritdoc}
     */
    public function fetchForecastByCityId($cityId)
    {
        $queryPart = '/forecast?id=' . $cityId;

        $queryPart = $queryPart . $this->getParams();

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * {@inheritdoc}
     */
    public function fetchForecastByCityGeographicCoordinates($latitude, $longitude)
    {
        $queryPart = '/forecast?lat=' . $latitude . '&lon=' . $longitude;

        $queryPart = $queryPart . $this->getParams();

        return $this->getResult(self::BASE_URL, $queryPart);
    }
}
