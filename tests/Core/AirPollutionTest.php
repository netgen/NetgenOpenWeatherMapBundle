<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Core;

use Netgen\Bundle\OpenWeatherMapBundle\API\OpenWeatherMap\Weather\AirPollutionInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\NoCache;
use Netgen\Bundle\OpenWeatherMapBundle\Core\AirPollution;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClient;
use Netgen\Bundle\OpenWeatherMapBundle\Http\HttpClientInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Http\JsonResponse as Response;
use PHPUnit\Framework\TestCase;

class AirPollutionTest extends TestCase
{
    public function testInstanceOfAirPollutionInterface()
    {
        $cacheHandler = $this->getMockForAbstractClass(HandlerInterface::class);
        $httpClient = $this->getMockForAbstractClass(HttpClientInterface::class);

        $airPollution = new AirPollution($httpClient, 'api_key', $cacheHandler, 3600);

        $this->assertInstanceOf(AirPollutionInterface::class, $airPollution);
    }

    public function testFetchOzoneDataFromCache()
    {
        $cacheHandler = $this->getMockBuilder(NoCache::class)
            ->disableOriginalConstructor()
            ->setMethods(array('has', 'get'))
            ->getMock();

        $cacheHandler->expects($this->once())
            ->willReturn(true)
            ->method('has');

        $cacheHandler->expects($this->once())
            ->willReturn('some_data')
            ->method('get');

        $httpClient = $this->getMockForAbstractClass(HttpClientInterface::class);

        $airPollution = new AirPollution($httpClient, 'api_key', $cacheHandler, 3600);

        $data = $airPollution->fetchOzoneData(23.5, 67.6);

        $this->assertEquals('some_data', $data);
    }

    public function testFetchOzoneDataFromRemoteService()
    {
        $cacheHandler = $this->getMockBuilder(NoCache::class)
            ->disableOriginalConstructor()
            ->setMethods(array('has', 'set'))
            ->getMock();

        $cacheHandler->expects($this->any())
            ->willReturn(false)
            ->method('has');

        $cacheHandler->expects($this->any())
            ->method('set');

        $httpClient = $this->getMockBuilder(HttpClient::class)
            ->disableOriginalConstructor()
            ->setMethods(array('get'))
            ->getMock();

        $response = new Response('some_data', 200);

        $httpClient->expects($this->any())
            ->willReturn($response)
            ->method('get');

        $airPollution = new AirPollution($httpClient, 'api_key', $cacheHandler, 3600);
        $data = $airPollution->fetchOzoneData(23.5, 67.6);
        $this->assertEquals('some_data', $data);

        $data = $airPollution->fetchOzoneData(23.5, 67.6, new \DateTime());
        $this->assertEquals('some_data', $data);

        $data = $airPollution->fetchOzoneData(23.5, 67.6, 'current');
        $this->assertEquals('some_data', $data);
    }

    /**
     * @expectedException \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException
     */
    public function testFetchOzoneDataWhenRequestIsNotAuthorized()
    {
        $cacheHandler = $this->getMockBuilder(NoCache::class)
            ->disableOriginalConstructor()
            ->setMethods(array('has'))
            ->getMock();

        $cacheHandler->expects($this->once())
            ->willReturn(false)
            ->method('has');

        $httpClient = $this->getMockBuilder(HttpClient::class)
            ->disableOriginalConstructor()
            ->setMethods(array('get'))
            ->getMock();

        $response = new Response('some_data', 401);

        $httpClient->expects($this->any())
            ->willReturn($response)
            ->method('get');

        $airPollution = new AirPollution($httpClient, 'api_key', $cacheHandler, 3600);
        $airPollution->fetchOzoneData(23.5, 67.6);
    }

    /**
     * @expectedException \Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException
     */
    public function testFetchOzoneDataWhenRequestIsNotOk()
    {
        $cacheHandler = $this->getMockBuilder(NoCache::class)
            ->disableOriginalConstructor()
            ->setMethods(array('has'))
            ->getMock();

        $cacheHandler->expects($this->once())
            ->willReturn(false)
            ->method('has');

        $httpClient = $this->getMockBuilder(HttpClient::class)
            ->disableOriginalConstructor()
            ->setMethods(array('get'))
            ->getMock();

        $response = new Response('some_data', 404);

        $httpClient->expects($this->any())
            ->willReturn($response)
            ->method('get');

        $airPollution = new AirPollution($httpClient, 'api_key', $cacheHandler, 3600);
        $airPollution->fetchOzoneData(23.5, 67.6);
    }

    public function testFetchCarbonMonoxideDataFromCache()
    {
        $cacheHandler = $this->getMockBuilder(NoCache::class)
            ->disableOriginalConstructor()
            ->setMethods(array('has', 'get'))
            ->getMock();

        $cacheHandler->expects($this->once())
            ->willReturn(true)
            ->method('has');

        $cacheHandler->expects($this->once())
            ->willReturn('some_data')
            ->method('get');

        $httpClient = $this->getMockForAbstractClass(HttpClientInterface::class);

        $airPollution = new AirPollution($httpClient, 'api_key', $cacheHandler, 3600);

        $data = $airPollution->fetchCarbonMonoxideData(23.5, 67.6);

        $this->assertEquals('some_data', $data);
    }

    public function testFetchCarbonMonoxideDataFromRemoteService()
    {
        $cacheHandler = $this->getMockBuilder(NoCache::class)
            ->disableOriginalConstructor()
            ->setMethods(array('has', 'set'))
            ->getMock();

        $cacheHandler->expects($this->any())
            ->willReturn(false)
            ->method('has');

        $cacheHandler->expects($this->any())
            ->method('set');

        $httpClient = $this->getMockBuilder(HttpClient::class)
            ->disableOriginalConstructor()
            ->setMethods(array('get'))
            ->getMock();

        $response = new Response('some_data', 200);

        $httpClient->expects($this->any())
            ->willReturn($response)
            ->method('get');

        $airPollution = new AirPollution($httpClient, 'api_key', $cacheHandler, 3600);
        $data = $airPollution->fetchCarbonMonoxideData(23.5, 67.6);
        $this->assertEquals('some_data', $data);

        $data = $airPollution->fetchCarbonMonoxideData(23.5, 67.6, new \DateTime());
        $this->assertEquals('some_data', $data);

        $data = $airPollution->fetchCarbonMonoxideData(23.5, 67.6, 'current');
        $this->assertEquals('some_data', $data);
    }
}
