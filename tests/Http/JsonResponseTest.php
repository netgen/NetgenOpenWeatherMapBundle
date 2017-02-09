<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Http;

use Netgen\Bundle\OpenWeatherMapBundle\Http\JsonResponse;
use Netgen\Bundle\OpenWeatherMapBundle\Http\ResponseInterface;
use PHPUnit\Framework\TestCase;

class JsonResponseTest extends TestCase
{
    public function testInstanceOfResponseInterface()
    {
        $response = new JsonResponse('data', 200);

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function testConstructWithValidJson()
    {
        $response = new JsonResponse('{"cod":401,"message":"Test"}', 200);

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertEquals('Test', $response->getMessage());
        $this->assertEquals(array('cod' => 401, 'message' => 'Test'), $response->getData());
        $this->assertEquals('{"cod":401,"message":"Test"}', (string)$response);
    }
}
