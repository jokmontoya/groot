<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use FosterCommerce\Groot\Providers\FilesystemServiceProvider;
use FosterCommerce\Groot\Providers\TwigServiceProvider;
use FosterCommerce\Groot\Container;

class TestCase extends BaseTestCase
{
    function setup()
    {
        $this->configureContainer();
    }

    private function configureContainer()
    {
        $container = new Container;

        $container->register(new TwigServiceProvider);
        $container->register(new FilesystemServiceProvider);

        Container::setInstance($container);
    }
}
