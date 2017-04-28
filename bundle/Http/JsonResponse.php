<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Http;

/**
 * Class JsonResponse.
 */
class JsonResponse implements ResponseInterface
{
    /**
     * @var array|string
     */
    protected $data;

    /**
     * @var int
     */
    protected $httpCode;

    /**
     * Response constructor.
     *
     * @param string $data
     * @param int $httpCode
     */
    public function __construct($data, $httpCode)
    {
        if ($this->isValidJson($data)) {
            $data = json_decode($data, true);
        }
        $this->data = $data;

        if (is_array($data) && array_key_exists('cod', $data)) {
            $this->httpCode = (int) $data['cod'];
        } else {
            $this->httpCode = $httpCode;
        }
    }

    /**
     * Returns data represented as string.
     *
     * @return string
     */
    public function __toString()
    {
        if (is_array($this->data)) {
            return json_encode($this->data);
        }

        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode()
    {
        return $this->httpCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function isOk()
    {
        if ($this->httpCode === 200) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isAuthorized()
    {
        if ($this->httpCode !== 401) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        if (is_array($this->data) && array_key_exists('message', $this->data)) {
            return $this->data['message'];
        }

        return '';
    }

    /**
     * Checks if given string is valid json.
     *
     * @param string $string
     *
     * @return bool
     */
    protected function isValidJson($string)
    {
        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
