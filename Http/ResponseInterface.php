<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Http;
/**
 * Interface ResponseInterface
 * @package Netgen\Bundle\OpenWeatherMapBundle\Http
 */
interface ResponseInterface
{
    /**
     * Returns HTTP status code
     *
     * @return integer
     */
    public function getStatusCode();

    /**
     * Returns data from remote service
     *
     * @return array
     */
    public function getData();

    /**
     * Returns true is HTTP status code is 200
     *
     * @return boolean
     */
    public function isOk();

    /**
     * Returns true is HTTP status code is not 401
     *
     * @return boolean
     */
    public function isAuthorized();

    /**
     * Returns message in case of error
     *
     * @return string
     */
    public function getMessage();
}
