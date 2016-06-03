<?php

namespace Netgen\Bundle\OpenWeatherMapBundle\Tests\Factory;

use Netgen\Bundle\OpenWeatherMapBundle\Cache\HandlerInterface;
use Netgen\Bundle\OpenWeatherMapBundle\Cache\Null;
use Netgen\Bundle\OpenWeatherMapBundle\Factory\CacheHandlerFactory;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CacheHandlerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOfContainerAware()
    {
        $factory = new CacheHandlerFactory();
        $this->assertInstanceOf(ContainerAware::class, $factory);
    }

    public function testGetCacheHandler()
    {
        $cacheHandler = $this->getMockForAbstractClass(HandlerInterface::class);

        $container = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->setMethods(array('get'))
            ->getMock();

        $container->expects($this->once())
            ->willReturn($cacheHandler)
            ->method('get');

        $factory = new CacheHandlerFactory();
        $factory->setContainer($container);

        $this->assertSame($cacheHandler, $factory->getCacheHandler('null'));
    }
}
