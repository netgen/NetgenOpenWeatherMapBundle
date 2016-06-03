<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\WeatherStationsInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\Null;
use Netgen\Bundle\OpenWeatherMapBundle\Core\WeatherStations;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClient;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\JsonResponse;

class WeatherStationsTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOfWeatherStationsInterface()
    {
        $cacheHandler = $this->getMockForAbstractClass(HandlerInterface::class);
        $httpClient = $this->getMockForAbstractClass(HttpClientInterface::class);

        $weatherStations = new WeatherStations($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');

        $this->assertInstanceOf(WeatherStationsInterface::class, $weatherStations);
    }

    public function testFetchFromOnStationById()
    {
        $cacheHandler = $this->getMockBuilder(Null::class)
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

        $weatherStations = new WeatherStations($httpClient, 'api_key', $cacheHandler, 3600);
        $data = $weatherStations->fetchFromOnStationById(123);
        $this->assertEquals("some_data", $data);
    }

    public function testFetchFromSeveralByRectangleZone()
    {
        $cacheHandler = $this->getMockBuilder(Null::class)
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

        $weatherStations = new WeatherStations($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weatherStations->fetchFromSeveralByRectangleZone($boundingBox, 'yes');
        $this->assertEquals("some_data", $data);
    }

    public function testFetchFromSeveralByGeoPoint()
    {
        $cacheHandler = $this->getMockBuilder(Null::class)
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

        $weatherStations = new WeatherStations($httpClient, 'api_key', $cacheHandler, 3600, 'metric', 'en', 'accurate');
        $data = $weatherStations->fetchFromSeveralByGeoPoint(35, 129, 10);
        $this->assertEquals("some_data", $data);
    }
}
