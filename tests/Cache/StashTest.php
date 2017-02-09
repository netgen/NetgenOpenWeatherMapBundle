<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Cache;

use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\Stash;
use Stash\Item;
use Tedivm\StashBundle\Service\CacheService;
use PHPUnit\Framework\TestCase;

class StashTest extends TestCase
{
    public function testInstanceOfHandlerInterface()
    {
        $cacheService = $this->getMockBuilder(CacheService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $handler = new Stash($cacheService);

        $this->assertInstanceOf(HandlerInterface::class, $handler);
    }

    public function testCacheHasKeyMethod()
    {
        $cacheService = $this->getMockBuilder(CacheService::class)
            ->disableOriginalConstructor()
            ->setMethods(array('getItem', 'isMiss'))
            ->getMock();

        $item = $this->getMockBuilder(Item::class)
            ->disableOriginalConstructor()
            ->setMethods(array('isMiss'))
            ->getMock();

        $cacheService->expects($this->once())
            ->willReturn($item)
            ->method('getItem');

        $item->expects($this->once())
            ->willReturn(false)
            ->method('isMiss');

        $handler = new Stash($cacheService);

        $this->assertTrue($handler->has('some_key'));
    }

    public function testCacheHasNotKeyMethod()
    {
        $cacheService = $this->getMockBuilder(CacheService::class)
            ->disableOriginalConstructor()
            ->setMethods(array('getItem', 'isMiss'))
            ->getMock();

        $item = $this->getMockBuilder(Item::class)
            ->disableOriginalConstructor()
            ->setMethods(array('isMiss'))
            ->getMock();

        $cacheService->expects($this->once())
            ->willReturn($item)
            ->method('getItem');

        $item->expects($this->once())
            ->willReturn(true)
            ->method('isMiss');

        $handler = new Stash($cacheService);

        $this->assertFalse($handler->has('some_key'));
    }

    public function testGetMethod()
    {
        $cacheService = $this->getMockBuilder(CacheService::class)
            ->disableOriginalConstructor()
            ->setMethods(array('getItem', 'isMiss'))
            ->getMock();

        $item = $this->getMockBuilder(Item::class)
            ->disableOriginalConstructor()
            ->setMethods(array('isMiss', 'get'))
            ->getMock();

        $cacheService->expects($this->once())
            ->willReturn($item)
            ->method('getItem');

        $item->expects($this->once())
            ->willReturn(false)
            ->method('isMiss');

        $item->expects($this->once())
            ->willReturn('some_data')
            ->method('get');

        $handler = new Stash($cacheService);

        $this->assertEquals('some_data', $handler->get('some_key'));
    }

    public function testGetDoesNotReturnsDataMethod()
    {
        $cacheService = $this->getMockBuilder(CacheService::class)
            ->disableOriginalConstructor()
            ->setMethods(array('getItem', 'isMiss'))
            ->getMock();

        $item = $this->getMockBuilder(Item::class)
            ->disableOriginalConstructor()
            ->setMethods(array('isMiss', 'get'))
            ->getMock();

        $cacheService->expects($this->once())
            ->willReturn($item)
            ->method('getItem');

        $item->expects($this->once())
            ->willReturn(true)
            ->method('isMiss');

        $handler = new Stash($cacheService);

        $this->assertFalse($handler->get('some_key'));
    }

    public function testSetMethod()
    {
        $cacheService = $this->getMockBuilder(CacheService::class)
            ->disableOriginalConstructor()
            ->setMethods(array('getItem', 'isMiss'))
            ->getMock();

        $item = $this->getMockBuilder(Item::class)
            ->disableOriginalConstructor()
            ->setMethods(array('set'))
            ->getMock();

        $cacheService->expects($this->once())
            ->willReturn($item)
            ->method('getItem');

        $item->expects($this->once())
            ->method('set');

        $handler = new Stash($cacheService);

        $handler->set('some_key', 'some_data', 3600);
    }
}
