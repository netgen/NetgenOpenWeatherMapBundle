<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\Controller\DailyForecastController;
use Netgen\Bundle\OpenWeatherMapBundle\Core\DailyForecast;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\TestCase;

class DailyForecastControllerTest extends TestCase
{
    public function testGetForecastByCityName()
    {
        $dailyForecast = $this->getMockBuilder(DailyForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityName'))
            ->getMock();

        $dailyForecast->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchForecastByCityName');

        $dailyForecastController = new DailyForecastController($dailyForecast);
        $response = $dailyForecastController->getForecastByCityName('London', 10, 'uk');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetForecastByCityNameWithNotAuthorizedException()
    {
        $dailyForecast = $this->getMockBuilder(DailyForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityName'))
            ->getMock();

        $dailyForecast->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchForecastByCityName');

        $dailyForecastController = new DailyForecastController($dailyForecast);
        $response = $dailyForecastController->getForecastByCityName('London', 10, 'uk');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testGetForecastByCityNameWithNotFoundException()
    {
        $dailyForecast = $this->getMockBuilder(DailyForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityName'))
            ->getMock();

        $dailyForecast->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchForecastByCityName');

        $dailyForecastController = new DailyForecastController($dailyForecast);
        $response = $dailyForecastController->getForecastByCityName('London', 10, 'uk');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testGetForecastByCityId()
    {
        $dailyForecast = $this->getMockBuilder(DailyForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityId'))
            ->getMock();

        $dailyForecast->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchForecastByCityId');

        $dailyForecastController = new DailyForecastController($dailyForecast);
        $response = $dailyForecastController->getForecastByCityId(9040, 10);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetForecastByCityIdWithNotAuthorizedException()
    {
        $dailyForecast = $this->getMockBuilder(DailyForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityId'))
            ->getMock();

        $dailyForecast->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchForecastByCityId');

        $dailyForecastController = new DailyForecastController($dailyForecast);
        $response = $dailyForecastController->getForecastByCityId(9040, 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testGetForecastByCityIdWithNotFoundException()
    {
        $dailyForecast = $this->getMockBuilder(DailyForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityId'))
            ->getMock();

        $dailyForecast->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchForecastByCityId');

        $dailyForecastController = new DailyForecastController($dailyForecast);
        $response = $dailyForecastController->getForecastByCityId(9040, 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testGetForecastByCityGeographicCoordinates()
    {
        $dailyForecast = $this->getMockBuilder(DailyForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityGeographicCoordinates'))
            ->getMock();

        $dailyForecast->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchForecastByCityGeographicCoordinates');

        $dailyForecastController = new DailyForecastController($dailyForecast);
        $response = $dailyForecastController->getForecastByCityGeographicCoordinates(32, 123, 10);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetForecastByCityGeographicCoordinatesWithNotAuthorizedException()
    {
        $dailyForecast = $this->getMockBuilder(DailyForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityGeographicCoordinates'))
            ->getMock();

        $dailyForecast->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchForecastByCityGeographicCoordinates');

        $dailyForecastController = new DailyForecastController($dailyForecast);
        $response = $dailyForecastController->getForecastByCityGeographicCoordinates(32, 123, 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testGetForecastByCityGeographicCoordinatesWithNotFoundException()
    {
        $dailyForecast = $this->getMockBuilder(DailyForecast::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchForecastByCityGeographicCoordinates'))
            ->getMock();

        $dailyForecast->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchForecastByCityGeographicCoordinates');

        $dailyForecastController = new DailyForecastController($dailyForecast);
        $response = $dailyForecastController->getForecastByCityGeographicCoordinates(32, 123, 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}
