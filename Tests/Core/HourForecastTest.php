<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\HourForecastInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\NoCache;
use Netgen\Bundle\OpenWeatherMapBundle\Core\HourForecast;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClient;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\JsonResponse;

class HourForecastTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOfHourForecastInterface()
    {
        $cacheHandler = $this->getMockForAbstractClass(HandlerInterface::class);
        $httpClient = $this->getMockForAbstractClass(HttpClientInterface::class);

        $hourForecast = new HourForecast($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');

        $this->assertInstanceOf(HourForecastInterface::class, $hourForecast);
    }

    public function testFetchForecastByCityName()
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

        $response = new JsonResponse("some_data", 200);

        $httpClient->expects($this->once())
            ->willReturn($response)
            ->method('get');

        $hourForecast = new HourForecast($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $hourForecast->fetchForecastByCityName('London', 'uk');
        $this->assertEquals("some_data", $data);
    }

    public function testFetchForecastByCityNameWithoutCountryCode()
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

        $response = new JsonResponse("some_data", 200);

        $httpClient->expects($this->once())
            ->willReturn($response)
            ->method('get');

        $hourForecast = new HourForecast($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $hourForecast->fetchForecastByCityName('London');
        $this->assertEquals("some_data", $data);
    }

    public function testFetchForecastByCityId()
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

        $response = new JsonResponse("some_data", 200);

        $httpClient->expects($this->once())
            ->willReturn($response)
            ->method('get');

        $hourForecast = new HourForecast($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $hourForecast->fetchForecastByCityId(524901);
        $this->assertEquals("some_data", $data);
    }

    public function testFetchForecastByCityGeographicCoordinates()
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

        $response = new JsonResponse("some_data", 200);

        $httpClient->expects($this->once())
            ->willReturn($response)
            ->method('get');

        $hourForecast = new HourForecast($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $hourForecast->fetchForecastByCityGeographicCoordinates(35, 139);
        $this->assertEquals("some_data", $data);
    }
}
