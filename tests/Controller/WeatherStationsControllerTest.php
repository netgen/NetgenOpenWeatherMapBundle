<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\Controller\WeatherStationsController;
use Netgen\Bundle\OpenWeatherMapBundle\Core\WeatherStations;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class WeatherStationsControllerTest extends TestCase
{
    public function testGetFromOnStationById()
    {
        $weatherStations = $this->getMockBuilder(WeatherStations::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchFromOnStationById'))
            ->getMock();

        $weatherStations->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchFromOnStationById');

        $weatherStationsController = new WeatherStationsController($weatherStations);
        $response = $weatherStationsController->getFromOnStationById(123456);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetFromOnStationByIdWithNotAuthorizedException()
    {
        $weatherStations = $this->getMockBuilder(WeatherStations::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchFromOnStationById'))
            ->getMock();

        $weatherStations->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchFromOnStationById');

        $weatherStationsController = new WeatherStationsController($weatherStations);
        $response = $weatherStationsController->getFromOnStationById(123456);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testGetFromOnStationByIdWithNotFoundException()
    {
        $weatherStations = $this->getMockBuilder(WeatherStations::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchFromOnStationById'))
            ->getMock();

        $weatherStations->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchFromOnStationById');

        $weatherStationsController = new WeatherStationsController($weatherStations);
        $response = $weatherStationsController->getFromOnStationById(123456);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testGetFromSeveralByRectangleZone()
    {
        $weatherStations = $this->getMockBuilder(WeatherStations::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchFromSeveralByRectangleZone'))
            ->getMock();

        $weatherStations->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchFromSeveralByRectangleZone');

        $weatherStationsController = new WeatherStationsController($weatherStations);
        $response = $weatherStationsController->getFromSeveralByRectangleZone(20, 24, 45, 56, 5, 'yes', 10);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetFromSeveralByRectangleZoneWithNotAuthorizedException()
    {
        $weatherStations = $this->getMockBuilder(WeatherStations::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchFromSeveralByRectangleZone'))
            ->getMock();

        $weatherStations->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchFromSeveralByRectangleZone');

        $weatherStationsController = new WeatherStationsController($weatherStations);
        $response = $weatherStationsController->getFromSeveralByRectangleZone(20, 24, 45, 56, 5, 'yes', 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testGetFromSeveralByRectangleZoneWithNotFoundException()
    {
        $weatherStations = $this->getMockBuilder(WeatherStations::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchFromSeveralByRectangleZone'))
            ->getMock();

        $weatherStations->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchFromSeveralByRectangleZone');

        $weatherStationsController = new WeatherStationsController($weatherStations);
        $response = $weatherStationsController->getFromSeveralByRectangleZone(20, 24, 45, 56, 5, 'yes', 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testGetFromSeveralByGeoPoint()
    {
        $weatherStations = $this->getMockBuilder(WeatherStations::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchFromSeveralByGeoPoint'))
            ->getMock();

        $weatherStations->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchFromSeveralByGeoPoint');

        $weatherStationsController = new WeatherStationsController($weatherStations);
        $response = $weatherStationsController->getFromSeveralByGeoPoint(20, 123, 10);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetFromSeveralByGeoPointWithNotAuthorizedException()
    {
        $weatherStations = $this->getMockBuilder(WeatherStations::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchFromSeveralByGeoPoint'))
            ->getMock();

        $weatherStations->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchFromSeveralByGeoPoint');

        $weatherStationsController = new WeatherStationsController($weatherStations);
        $response = $weatherStationsController->getFromSeveralByGeoPoint(20, 123, 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testGetFromSeveralByGeoPointWithNotFoundException()
    {
        $weatherStations = $this->getMockBuilder(WeatherStations::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchFromSeveralByGeoPoint'))
            ->getMock();

        $weatherStations->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchFromSeveralByGeoPoint');

        $weatherStationsController = new WeatherStationsController($weatherStations);
        $response = $weatherStationsController->getFromSeveralByGeoPoint(20, 123, 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}
