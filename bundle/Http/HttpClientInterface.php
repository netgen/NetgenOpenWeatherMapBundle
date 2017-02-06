<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Http;

/**
 * Interface HttpClientInterface.
 */
interface HttpClientInterface
{
    /**
     * Performs get request to given URL.
     *
     * @param string $url
     *
     * @return ResponseInterface
     */
    public function get($url);
}
