<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\Controller\WeatherController;
use Netgen\Bundle\OpenWeatherMapBundle\Core\Weather;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\TestCase;

class WeatherControllerTest extends TestCase
{
    public function testByGeographicCoordinates()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByGeographicCoordinates'))
            ->getMock();

        $weather->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchWeatherDataByGeographicCoordinates');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byGeographicCoordinates(20, 139);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testByGeographicCoordinatesWithNotAuthorizedException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByGeographicCoordinates'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchWeatherDataByGeographicCoordinates');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byGeographicCoordinates(20, 139);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testByGeographicCoordinatesWithNotFoundException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByGeographicCoordinates'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchWeatherDataByGeographicCoordinates');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byGeographicCoordinates(20, 139);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testByCityName()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByCityName'))
            ->getMock();

        $weather->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchWeatherDataByCityName');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byCityName('London', 'uk');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testByCityNameWithNotAuthorizedException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByCityName'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchWeatherDataByCityName');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byCityName('London', 'uk');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testByCityNameWithNotFoundException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByCityName'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchWeatherDataByCityName');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byCityName('London', 'uk');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testByCityId()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByCityId'))
            ->getMock();

        $weather->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchWeatherDataByCityId');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byCityId(12345);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testByCityIdWithNotAuthorizedException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByCityId'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchWeatherDataByCityId');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byCityId(12345);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testByCityIdWithNotFoundException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByCityId'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchWeatherDataByCityId');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byCityId(12345);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testByZipCode()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByZipCode'))
            ->getMock();

        $weather->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchWeatherDataByZipCode');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byZipCode(12345, 'uk');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testByZipCodeWithNotAuthorizedException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByZipCode'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchWeatherDataByZipCode');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byZipCode(12345, 'uk');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testByZipCodeWithNotFoundException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataByZipCode'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchWeatherDataByZipCode');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byZipCode(12345, 'uk');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testByRectangleZone()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataForCitiesWithinRectangleZone'))
            ->getMock();

        $weather->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchWeatherDataForCitiesWithinRectangleZone');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byRectangleZone(20, 129, 30, 140, 5, 'yes');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testByRectangleZoneWithNotAuthorizedException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataForCitiesWithinRectangleZone'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchWeatherDataForCitiesWithinRectangleZone');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byRectangleZone(20, 129, 30, 140, 5, 'yes');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testByRectangleZoneWithNotFoundException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataForCitiesWithinRectangleZone'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchWeatherDataForCitiesWithinRectangleZone');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byRectangleZone(20, 129, 30, 140, 5, 'yes');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testByCircle()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataForCitiesInCycle'))
            ->getMock();

        $weather->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchWeatherDataForCitiesInCycle');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byCircle(20, 130, 'yes', 10);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testByCircleWithNotAuthorizedException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataForCitiesInCycle'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchWeatherDataForCitiesInCycle');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byCircle(20, 130, 'yes', 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testByCircleWithNotFoundException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataForCitiesInCycle'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchWeatherDataForCitiesInCycle');

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byCircle(20, 130, 'yes', 10);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testByCityIds()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataForSeveralCityIds'))
            ->getMock();

        $weather->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchWeatherDataForSeveralCityIds');

        $request = new Request(array('cities' => 12));

        $weatherController = new WeatherController($weather);
        $response = $weatherController->byCityIds($request);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testByCityIdsWithNotAuthorizedException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataForSeveralCityIds'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchWeatherDataForSeveralCityIds');

        $weatherController = new WeatherController($weather);

        $request = new Request(array('cities' => 12));

        $response = $weatherController->byCityIds($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not authorized', $response->getContent());
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testByCityIdsWithNotFoundException()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataForSeveralCityIds'))
            ->getMock();

        $weather->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchWeatherDataForSeveralCityIds');

        $weatherController = new WeatherController($weather);

        $request = new Request(array('cities' => 12));

        $response = $weatherController->byCityIds($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Not found', $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testByCityIdsWithBadRequest()
    {
        $weather = $this->getMockBuilder(Weather::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchWeatherDataForSeveralCityIds'))
            ->getMock();

        $weather->expects($this->never())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchWeatherDataForSeveralCityIds');

        $weatherController = new WeatherController($weather);

        $request = new Request(array());

        $response = $weatherController->byCityIds($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('', $response->getContent());
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
