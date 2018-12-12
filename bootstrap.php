<?php

use FosterCommerce\Groot\Providers\FilesystemServiceProvider;
use FosterCommerce\Groot\Providers\TwigServiceProvider;
use FosterCommerce\Groot\Container;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
} else {
    require __DIR__ . '/../../autoload.php';
}

$container = new Container;

$container->register(new TwigServiceProvider);
$container->register(new FilesystemServiceProvider);

Container::setInstance($container);
