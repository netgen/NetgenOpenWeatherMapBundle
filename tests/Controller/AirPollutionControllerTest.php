<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Controller;

use Marek\OpenWeatherMap\API\Exception\APIException;
use Marek\OpenWeatherMap\API\Exception\BadRequestException;
use Marek\OpenWeatherMap\API\Exception\NotFoundException;
use Marek\OpenWeatherMap\API\Weather\Services\AirPollutionInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Controller\AirPollutionController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class AirPollutionControllerTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $airPollution;

    /**
     * @var AirPollutionController
     */
    protected $controller;

    public function setUp()
    {
        $this->airPollution = $this->getMockBuilder(AirPollutionInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchOzoneData', 'fetchCarbonMonoxideData', 'fetchSulfurDioxideData', 'fetchNitrogenDioxideData'))
            ->getMock();

        $this->controller = new AirPollutionController($this->airPollution);
    }
    public function testCallOzoneDataWithDatetimeStringCurrent()
    {
        $this->airPollution->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchOzoneData');

        $response = $this->controller->getOzoneData(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testCallOzoneDataWithDatetimeAsInvalidDate()
    {
        $this->airPollution->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchOzoneData');

        $response = $this->controller->getOzoneData(12.7, 45.3, 'test');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testCallOzoneDataWithValidDatetimeString()
    {
        $this->airPollution->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchOzoneData');

        $response = $this->controller->getOzoneData(12.7, 45.3, 'test');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testCallOzoneDataWithNotAuthorizedException()
    {
        $this->airPollution->expects($this->once())
            ->willThrowException(new BadRequestException("Bad request", APIException::BAD_REQUEST))
            ->method('fetchOzoneData');
        
        $response = $this->controller->getOzoneData(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testCallOzoneDataWithNotFoundException()
    {
        $this->airPollution->expects($this->once())
            ->willThrowException(new NotFoundException("Not found", APIException::NOT_FOUND))
            ->method('fetchOzoneData');

        $response = $this->controller->getOzoneData(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testCallCarbonMonoxideDataWithDatetimeAsInvalidDate()
    {
        $this->airPollution->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchCarbonMonoxideData');

        $response = $this->controller->getCarbonMonoxideData(12.7, 45.3, 'test');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testCallCarbonMonoxideDataWithCurrentAsDatetimeString()
    {
        $this->airPollution->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchCarbonMonoxideData');

        $response = $this->controller->getCarbonMonoxideData(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testCallCarbonMonoxideDataWithValidDatetimeString()
    {
        $this->airPollution->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchCarbonMonoxideData');

        $response = $this->controller->getCarbonMonoxideData(12.7, 45.3, 'test');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testCallCarbonMonoxideDataWithNotAuthorizedException()
    {
        $this->airPollution->expects($this->once())
            ->willThrowException(new BadRequestException("Bad request", APIException::BAD_REQUEST))
            ->method('fetchCarbonMonoxideData');

        $response = $this->controller->getCarbonMonoxideData(12.7, 45.3, 'test');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testCallCarbonMonoxideDataWithNotFoundException()
    {
        $this->airPollution->expects($this->once())
            ->willThrowException(new NotFoundException("Not Found", APIException::NOT_FOUND))
            ->method('fetchCarbonMonoxideData');

        $response = $this->controller->getCarbonMonoxideData(12.7, 45.3, 'test');

        $this->assertInstanceOf(Response::class, $response);
    }
}
