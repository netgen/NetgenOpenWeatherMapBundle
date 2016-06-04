<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\NoCache;
use Netgen\Bundle\OpenWeatherMapBundle\Core\Weather;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClient;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\JsonResponse;

class WeatherTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOfWeatherInterface()
    {
        $cacheHandler = $this->getMockForAbstractClass(HandlerInterface::class);
        $httpClient = $this->getMockForAbstractClass(HttpClientInterface::class);

        $weather = new Weather($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');

        $this->assertInstanceOf(WeatherInterface::class, $weather);
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

        $weather = new Weather($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weather->fetchWeatherDataByCityName('London', 'uk');
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

        $weather = new Weather($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weather->fetchWeatherDataByCityName('London');
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

        $weather = new Weather($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weather->fetchWeatherDataByCityId(524901);
        $this->assertEquals("some_data", $data);
    }

    public function testFetchForecastByZipCode()
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

        $weather = new Weather($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weather->fetchWeatherDataByZipCode(94040, 'us');
        $this->assertEquals("some_data", $data);
    }

    public function testFetchForecastByZipCodeWithoutCountryCode()
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

        $weather = new Weather($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weather->fetchWeatherDataByZipCode(94040);
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

        $weather = new Weather($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weather->fetchWeatherDataByGeographicCoordinates(35, 139);
        $this->assertEquals("some_data", $data);
    }

    public function testFetchWeatherDataForCitiesWithinRectangleZone()
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

        $boundingBox = array(
            12,32,15,37,10
        );

        $weather = new Weather($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weather->fetchWeatherDataForCitiesWithinRectangleZone($boundingBox, 'yes');
        $this->assertEquals("some_data", $data);
    }

    public function testFetchWeatherDataForCitiesInCycle()
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

        $weather = new Weather($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weather->fetchWeatherDataForCitiesInCycle(35, 129, 'yes', 10);
        $this->assertEquals("some_data", $data);
    }

    public function testFetchWeatherDataForSeveralCityIds()
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

        $weather = new Weather($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weather->fetchWeatherDataForSeveralCityIds(array(23, 34, 354, 546));
        $this->assertEquals("some_data", $data);
    }
}
