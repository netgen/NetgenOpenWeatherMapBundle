<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Controller;

use Netgen\Bundle\OpenWeatherMapBundle\Controller\UltravioletIndexController;
use Netgen\Bundle\OpenWeatherMapBundle\Core\UltravioletIndex;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotAuthorizedException;
use Netgen\Bundle\OpenWeatherMapBundle\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\TestCase;

class UltravioletIndexControllerTest extends TestCase
{
    public function testGetUltravioletIndex()
    {
        $ultravioletIndex = $this->getMockBuilder(UltravioletIndex::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchUltravioletIndex'))
            ->getMock();

        $ultravioletIndex->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchUltravioletIndex');

        $ultravioletIndexController = new UltravioletIndexController($ultravioletIndex);
        $response = $ultravioletIndexController->getUltravioletIndex(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetUltravioletIndexWithInvalidDateString()
    {
        $ultravioletIndex = $this->getMockBuilder(UltravioletIndex::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchUltravioletIndex'))
            ->getMock();

        $ultravioletIndex->expects($this->once())
            ->willReturn('some_data')
            ->method('fetchUltravioletIndex');

        $ultravioletIndexController = new UltravioletIndexController($ultravioletIndex);
        $response = $ultravioletIndexController->getUltravioletIndex(12.7, 45.3, 'test');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetUltravioletIndexWithNotAuthorizedException()
    {
        $ultravioletIndex = $this->getMockBuilder(UltravioletIndex::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchUltravioletIndex'))
            ->getMock();

        $ultravioletIndex->expects($this->once())
            ->willThrowException(new NotAuthorizedException('Not authorized'))
            ->method('fetchUltravioletIndex');

        $ultravioletIndexController = new UltravioletIndexController($ultravioletIndex);
        $response = $ultravioletIndexController->getUltravioletIndex(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testGetUltravioletIndexWithNotFoundException()
    {
        $ultravioletIndex = $this->getMockBuilder(UltravioletIndex::class)
            ->disableOriginalConstructor()
            ->setMethods(array('fetchUltravioletIndex'))
            ->getMock();

        $ultravioletIndex->expects($this->once())
            ->willThrowException(new NotFoundException('Not found'))
            ->method('fetchUltravioletIndex');

        $ultravioletIndexController = new UltravioletIndexController($ultravioletIndex);
        $response = $ultravioletIndexController->getUltravioletIndex(12.7, 45.3, 'current');

        $this->assertInstanceOf(Response::class, $response);
    }
}
