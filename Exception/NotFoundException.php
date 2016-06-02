<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Exception;

use Exception;

/**
 * Class NotFoundException
 * @package Netgen\Bundle\OpenWeatherMapBundle\Exception
 */
class NotFoundException extends Exception
{
    /**
     * NotFoundException constructor.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message, null, null);
    }
}
