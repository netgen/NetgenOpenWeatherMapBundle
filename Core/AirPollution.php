<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface;

/**
 * Class AirPollution
 * @package Netgen\Bundle\OpenWeatherMapBundle\Core
 */
class AirPollution extends Base implements AirPollutionInterface
{
    /**
     * @inheritDoc
     */
    public function fetchOzoneData($latitude, $longitude, $datetime = 'current')
    {
        if ($datetime instanceof \DateTime) {
            $datetime = $datetime->format('c');
        } else {
            $datetime = 'current';
        }

        $queryPart = '/co/' . $latitude . ',' . $longitude . '/' . $datetime . '.json?appid=' . $this->apiKey;

        return $this->getResult(self::BASE_URL, $queryPart);
    }

    /**
     * @inheritDoc
     */
    public function fetchCarbonMonoxideData($latitude, $longitude, $datetime = 'current')
    {
        if ($datetime instanceof \DateTime) {
            $datetime = $datetime->format('c');
        } else {
            $datetime = 'current';
        }

        $queryPart = '/co/' . $latitude . ',' . $longitude . '/' . $datetime . '.json?appid=' . $this->apiKey;

        return $this->getResult(self::BASE_URL, $queryPart);
    }
}
