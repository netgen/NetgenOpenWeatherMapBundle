<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\DailyForecastInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\NoCache;
use Netgen\Bundle\OpenWeatherMapBundle\Core\DailyForecast;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClient;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\JsonResponse;
use PHPUnit\Framework\TestCase;

class DailyForecastTest extends TestCase
{
    public function testInstanceOfDailyForecastInterface()
    {
        $cacheHandler = $this->getMockForAbstractClass(HandlerInterface::class);
        $httpClient = $this->getMockForAbstractClass(HttpClientInterface::class);

        $dailyForecast = new DailyForecast($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');

        $this->assertInstanceOf(DailyForecastInterface::class, $dailyForecast);
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

        $response = new JsonResponse('some_data', 200);

        $httpClient->expects($this->once())
            ->willReturn($response)
            ->method('get');

        $dailyForecast = new DailyForecast($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $dailyForecast->fetchForecastByCityName('London', 'uk', 10);
        $this->assertEquals('some_data', $data);
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

        $response = new JsonResponse('some_data', 200);

        $httpClient->expects($this->once())
            ->willReturn($response)
            ->method('get');

        $dailyForecast = new DailyForecast($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $dailyForecast->fetchForecastByCityName('London', '', 10);
        $this->assertEquals('some_data', $data);
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

        $response = new JsonResponse('some_data', 200);

        $httpClient->expects($this->once())
            ->willReturn($response)
            ->method('get');

        $dailyForecast = new DailyForecast($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $dailyForecast->fetchForecastByCityId(524901);
        $this->assertEquals('some_data', $data);
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

        $response = new JsonResponse('some_data', 200);

        $httpClient->expects($this->once())
            ->willReturn($response)
            ->method('get');

        $dailyForecast = new DailyForecast($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $dailyForecast->fetchForecastByCityGeographicCoordinates(35, 139);
        $this->assertEquals('some_data', $data);
    }
}
