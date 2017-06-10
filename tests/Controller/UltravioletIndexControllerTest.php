<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Controller;

use Marek\OpenWeatherMap\API\Exception\APIException;
use Marek\OpenWeatherMap\API\Exception\NotFoundException;
use Netgen\Bundle\OpenWeatherMapBundle\Controller\UltravioletIndexController;
use Marek\OpenWeatherMap\API\Weather\Services\UltravioletIndexInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class UltravioletIndexControllerTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $ultravioletIndex;

    /**
     * @var UltravioletIndexController
     */
    protected $controller;

    public function setUp()
    {
        $this->ultravioletIndex = $this->getMockBuilder(UltravioletIndexInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchUltravioletIndex'))
            ->getMock();

        $this->controller = new UltravioletIndexController($this->ultravioletIndex);
    }

    public function testGetUltravioletIndex()
    {
        $this->ultravioletIndex->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchUltravioletIndex');

        $response = $this->controller->getUltravioletIndex(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetUltravioletIndexWithInvalidDateString()
    {
        $this->ultravioletIndex->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchUltravioletIndex');

        $response = $this->controller->getUltravioletIndex(12.7, 45.3, 'test');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetUltravioletIndexWithNotFoundException()
    {
        $this->ultravioletIndex->expects($this->once())
            ->willThrowException(new NotFoundException("Not found", APIException::NOT_FOUND))
            ->method('fetchUltravioletIndex');

        $response = $this->controller->getUltravioletIndex(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }
}
