<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Cache;

use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\NoCache;
use PHPUnit\Framework\TestCase;

class NoCacheTest extends TestCase
{
    /**
     * @var HandlerInterface
     */
    protected $handler;

    public function setUp()
    {
        $this->handler = new NoCache();
    }

    public function testInstanceOfHandlerInterface()
    {
        $this->assertInstanceOf(HandlerInterface::class, $this->handler);
    }

    public function testHasMethodMustAlwaysReturnFalse()
    {
        $this->assertFalse($this->handler->has('some_key'));
        $this->assertFalse($this->handler->has('test'));
        $this->assertFalse($this->handler->has('weather'));
    }

    /**
     * @expectedException \Netgen\Bundle\OpenWeatherMapBundle\Exception\ItemNotFoundException
     * @expectedExceptionMessage Item with key:some_key not found.
     */
    public function testGetMethodMustThrowException()
    {
        $this->handler->get('some_key');
    }

    public function testSetMethodShouldDoNothing()
    {
        $this->handler->set('some_key', 'data');
        $this->handler->set('test', 'data');
        $this->handler->set('weather', 'data');
    }
}
