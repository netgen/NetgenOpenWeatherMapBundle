<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface;

/**
 * Class DailyForecast.
 */
class DailyForecast extends WeatherBase implements DailyForecastInterface
{
    /**
     * {@inheritdoc}
     */
    public function fetchForecastByCityName($cityName, $countryCode = '', $numberOfDays = 16)
    {
        if (empty($countryCode)) {
            $queryPart = '/forecast/daily?q=' . $cityName . '&cnt=' . $numberOfDays;
        } else {
            $queryPart = '/forecast/daily?q=' . $cityName . ',' . $countryCode . '&cnt=' . $numberOfDays;
        }

        $queryPart = $queryPart . $this->getParams();

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * {@inheritdoc}
     */
    public function fetchForecastByCityId($cityId, $numberOfDays = 16)
    {
        $queryPart = '/forecast/daily?id=' . $cityId . '&cnt=' . $numberOfDays;

        $queryPart = $queryPart . $this->getParams();

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * {@inheritdoc}
     */
    public function fetchForecastByCityGeographicCoordinates($latitude, $longitude, $numberOfDays = 16)
    {
        $queryPart = '/forecast/daily?lat=' . $latitude . '&lon=' . $longitude . '&cnt=' . $numberOfDays;

        $queryPart = $queryPart . $this->getParams();

        return $this->getResult(self::BASE_URL, $queryPart);
    }
}
