<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Cache;

use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\NoCache;

class NoCacheTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOfHandlerInterface()
    {
        $this->assertInstanceOf(HandlerInterface::class, new NoCache());
    }

    public function testHasMethodMustAlwaysReturnFalse()
    {
        $nullHandler = new NoCache();

        $this->assertFalse($nullHandler->has('some_key'));
        $this->assertFalse($nullHandler->has('test'));
        $this->assertFalse($nullHandler->has('weather'));
    }

    public function testGetMethodMustAlwaysReturnFalse()
    {
        $nullHandler = new NoCache();

        $this->assertFalse($nullHandler->get('some_key'));
        $this->assertFalse($nullHandler->get('test'));
        $this->assertFalse($nullHandler->get('weather'));
    }

    public function testSetMethodShouldDoNothing()
    {
        $nullHandler = new NoCache();

        $nullHandler->set('some_key', 'data', 120);
        $nullHandler->set('test', 'data', 1000);
        $nullHandler->set('weather', 'data', 3600);
    }
}
