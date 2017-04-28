<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Cache;

use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\Stash;
use Stash\Item;
use Tedivm\StashBundle\Service\CacheService;
use PHPUnit\Framework\TestCase;

class StashTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $cacheService;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $itemHit;

    /**
     * @var int
     */
    protected $ttl;

    /**
     * @var HandlerInterface
     */
    protected $handler;

    public function setUp()
    {
        $this->cacheService = $this->getMockBuilder(CacheService::class)
            ->setMethods(array('getItem', 'isHit', 'isMiss', 'save', 'hasItem'))
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemHit = $this->getMockBuilder(Item::class)
            ->disableOriginalConstructor()
            ->setMethods(array('isHit', 'get', 'set', 'expiresAfter'))
            ->getMock();

        $this->ttl =155;

        $this->handler = new Stash($this->cacheService, $this->ttl);
    }

    public function testInstanceOfHandlerInterface()
    {
        $this->assertInstanceOf(HandlerInterface::class, $this->handler);
    }

    public function testCacheHasKeyMethod()
    {
        $this->cacheService->expects($this->once())
            ->willReturn(true)
            ->method('hasItem');

        $this->assertTrue($this->handler->has('some_key'));
    }

    public function testCacheHasNotKeyMethod()
    {
        $this->cacheService->expects($this->once())
            ->willReturn(false)
            ->method('hasItem');

        $this->assertFalse($this->handler->has('some_key'));
    }

    public function testGetMethod()
    {
        $this->cacheService->expects($this->once())
            ->willReturn($this->itemHit)
            ->method('getItem');

        $this->itemHit->expects($this->once())
            ->willReturn(true)
            ->method('isHit');

        $this->itemHit->expects($this->once())
            ->willReturn('some_data')
            ->method('get');

        $this->assertEquals('some_data', $this->handler->get('some_key'));
    }

    /**
     * @expectedException \Netgen\Bundle\OpenWeatherMapBundle\Exception\ItemNotFoundException
     * @expectedExceptionMessage Item with key:netgen-openweathermap-some_key not found.
     */
    public function testGetDoesNotReturnsDataMethod()
    {
        $this->cacheService->expects($this->once())
            ->willReturn($this->itemHit)
            ->method('getItem');

        $this->itemHit->expects($this->once())
            ->willReturn(false)
            ->method('isHit');

        $this->handler->get('some_key');
    }

    public function testSetMethod()
    {
        $this->cacheService->expects($this->once())
            ->willReturn($this->itemHit)
            ->method('getItem');

        $this->itemHit->expects($this->once())
            ->method('set')
            ->with('some_data');

        $this->itemHit->expects($this->once())
            ->method('expiresAfter')
            ->with($this->ttl);

        $this->handler->set('some_key', 'some_data');
    }
}
