<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Http;

/**
 * Interface HttpClientInterface
 * @package Netgen\Bundle\OpenWeatherMapBundle\Http
 */
interface HttpClientInterface
{
    /**
     * Performs get request to given URL
     *
     * @param string $url
     *
     * @return mixed
     */
    public function get($url);
}
