<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\Controller\UltravioletIndexController;
use Netgen\Bundle\OpenWeatherMapBundle\Core\UltravioletIndex;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Response;

class UltravioletIndexControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUltravioletIndex()
    {
        $ultraviletIndex = $this->getMockBuilder(UltravioletIndex::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchUltraviletIndex'))
            ->getMock();

        $ultraviletIndex->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchUltraviletIndex');

        $ultraviletIndexController = new UltravioletIndexController($ultraviletIndex);
        $response = $ultraviletIndexController->getUltravioletIndex(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetUltravioletIndexWithInvalidDateString()
    {
        $ultraviletIndex = $this->getMockBuilder(UltravioletIndex::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchUltraviletIndex'))
            ->getMock();

        $ultraviletIndex->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchUltraviletIndex');

        $ultraviletIndexController = new UltravioletIndexController($ultraviletIndex);
        $response = $ultraviletIndexController->getUltravioletIndex(12.7, 45.3, 'test');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetUltravioletIndexWithNotAuthorizedException()
    {
        $ultraviletIndex = $this->getMockBuilder(UltravioletIndex::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchUltraviletIndex'))
            ->getMock();

        $ultraviletIndex->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchUltraviletIndex');

        $ultraviletIndexController = new UltravioletIndexController($ultraviletIndex);
        $response = $ultraviletIndexController->getUltravioletIndex(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetUltravioletIndexWithNotFoundException()
    {
        $ultraviletIndex = $this->getMockBuilder(UltravioletIndex::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchUltraviletIndex'))
            ->getMock();

        $ultraviletIndex->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchUltraviletIndex');

        $ultraviletIndexController = new UltravioletIndexController($ultraviletIndex);
        $response = $ultraviletIndexController->getUltravioletIndex(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }
}
