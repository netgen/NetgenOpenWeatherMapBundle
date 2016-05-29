<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Http;

/**
 * Class HttpClient
 * @package Netgen\Bundle\OpenWeatherMapBundle\Http
 */
class HttpClient implements HttpClientInterface
{
    /**
     * @inheritDoc
     */
    public function get($url)
    {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($curlHandle);
        curl_close($curlHandle);

        return $response;
    }
}
