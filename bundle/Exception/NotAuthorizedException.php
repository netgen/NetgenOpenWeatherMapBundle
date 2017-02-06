<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Exception;

use Exception;

/**
 * Class NotAuthorizedException.
 */
class NotAuthorizedException extends Exception
{
    /**
     * NotAuthorizedException constructor.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message, null, null);
    }
}
