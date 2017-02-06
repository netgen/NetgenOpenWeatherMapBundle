<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\Controller\HourForecastController;
use Netgen\Bundle\OpenWeatherMapBundle\Core\HourForecast;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Response;

class HourForecastControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetForecastByCityName()
    {
        $hourForecast = $this->getMockBuilder(HourForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityName'))
            ->getMock();

        $hourForecast->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchForecastByCityName');

        $hourForecastController = new HourForecastController($hourForecast);
        $response = $hourForecastController->getForecastByCityName('London', 'uk');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetForecastByCityNameWithNotAuthorizedException()
    {
        $hourForecast = $this->getMockBuilder(HourForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityName'))
            ->getMock();

        $hourForecast->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchForecastByCityName');

        $hourForecastController = new HourForecastController($hourForecast);
        $response = $hourForecastController->getForecastByCityName('London', 'uk');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testGetForecastByCityNameWithNotFoundException()
    {
        $hourForecast = $this->getMockBuilder(HourForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityName'))
            ->getMock();

        $hourForecast->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchForecastByCityName');

        $hourForecastController = new HourForecastController($hourForecast);
        $response = $hourForecastController->getForecastByCityName('London', 'uk');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testGetForecastByCityId()
    {
        $hourForecast = $this->getMockBuilder(HourForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityId'))
            ->getMock();

        $hourForecast->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchForecastByCityId');

        $hourForecastController = new HourForecastController($hourForecast);
        $response = $hourForecastController->getForecastByCityId(94040);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetForecastByCityIdWithNotAuthorizedException()
    {
        $hourForecast = $this->getMockBuilder(HourForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityId'))
            ->getMock();

        $hourForecast->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchForecastByCityId');

        $hourForecastController = new HourForecastController($hourForecast);
        $response = $hourForecastController->getForecastByCityId(94040);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testGetForecastByCityIdWithNotFoundException()
    {
        $hourForecast = $this->getMockBuilder(HourForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityId'))
            ->getMock();

        $hourForecast->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchForecastByCityId');

        $hourForecastController = new HourForecastController($hourForecast);
        $response = $hourForecastController->getForecastByCityId(94040);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testGetForecastByCityGeographicCoordinates()
    {
        $hourForecast = $this->getMockBuilder(HourForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityGeographicCoordinates'))
            ->getMock();

        $hourForecast->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchForecastByCityGeographicCoordinates');

        $hourForecastController = new HourForecastController($hourForecast);
        $response = $hourForecastController->getForecastByCityGeographicCoordinates(23, 129);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetForecastByCityGeographicCoordinatesWithNotAuthorizedException()
    {
        $hourForecast = $this->getMockBuilder(HourForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityGeographicCoordinates'))
            ->getMock();

        $hourForecast->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchForecastByCityGeographicCoordinates');

        $hourForecastController = new HourForecastController($hourForecast);
        $response = $hourForecastController->getForecastByCityGeographicCoordinates(23, 129);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testGetForecastByCityGeographicCoordinatesWithNotFoundException()
    {
        $hourForecast = $this->getMockBuilder(HourForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityGeographicCoordinates'))
            ->getMock();

        $hourForecast->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchForecastByCityGeographicCoordinates');

        $hourForecastController = new HourForecastController($hourForecast);
        $response = $hourForecastController->getForecastByCityGeographicCoordinates(23, 129);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}
