<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\UltravioletIndexInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\NoCache;
use Netgen\Bundle\OpenWeatherMapBundle\Core\UltravioletIndex;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClient;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\JsonResponse;

class UltravioletIndexTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOfUltravioletIndexInterface()
    {
        $cacheHandler = $this->getMockForAbstractClass(HandlerInterface::class);
        $httpClient = $this->getMockForAbstractClass(HttpClientInterface::class);

        $ultravioletIndex = new UltravioletIndex($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');

        $this->assertInstanceOf(UltravioletIndexInterface::class, $ultravioletIndex);
    }

    public function testFetchUltravioletIndex()
    {
        $cacheHandler = $this->getMockBuilder(NoCache::class)
            ->disableOriginalConstructor()
            ->setMethods(array('has', 'set'))
            ->getMock();

        $cacheHandler->expects($this->once())
            ->willReturn(false)
            ->method('has');

        $cacheHandler->expects($this->once())
            ->method('set');

        $httpClient = $this->getMockBuilder(HttpClient::class)
            ->disableOriginalConstructor()
            ->setMethods(array('get'))
            ->getMock();

        $response = new JsonResponse('some_data', 200);

        $httpClient->expects($this->once())
            ->willReturn($response)
            ->method('get');

        $ultravioletIndex = new UltravioletIndex($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $ultravioletIndex->fetchUltraviletIndex(34, 129);
        $this->assertEquals('some_data', $data);
    }

    public function testFetchUltravioletIndexWithDate()
    {
        $cacheHandler = $this->getMockBuilder(NoCache::class)
            ->disableOriginalConstructor()
            ->setMethods(array('has', 'set'))
            ->getMock();

        $cacheHandler->expects($this->once())
            ->willReturn(false)
            ->method('has');

        $cacheHandler->expects($this->once())
            ->method('set');

        $httpClient = $this->getMockBuilder(HttpClient::class)
            ->disableOriginalConstructor()
            ->setMethods(array('get'))
            ->getMock();

        $response = new JsonResponse('some_data', 200);

        $httpClient->expects($this->once())
            ->willReturn($response)
            ->method('get');

        $ultravioletIndex = new UltravioletIndex($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $ultravioletIndex->fetchUltraviletIndex(34, 129, new \DateTime());
        $this->assertEquals('some_data', $data);
    }
}
