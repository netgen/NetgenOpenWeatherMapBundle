<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Http;

/**
 * Class Response
 * @package Netgen\Bundle\OpenWeatherMapBundle\Http
 */
class Response implements ResponseInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var integer
     */
    protected $httpCode;

    /**
     * Response constructor.
     *
     * @param array $data
     * @param integer $httpCode
     */
    public function __construct($data, $httpCode)
    {
        if (!empty($data)) {
            $data = json_decode($data, true);
        }
        $this->data = $data;

        if (is_array($data) && array_key_exists('cod', $data)) {
            $this->httpCode = (int)$data['cod'];
        } else {
            $this->httpCode = $httpCode;
        }
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        return $this->httpCode;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function isOk()
    {
        if ($this->httpCode == 200) {
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function isAuthorized()
    {
        if ($this->httpCode != 401) {
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function getMessage()
    {
        if (is_array($this->data) && array_key_exists('message', $this->data)) {
            return $this->data['message'];
        }

        return '';
    }


    /**
     * Returns data represented as string
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->data);
    }
}
