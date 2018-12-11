<?php

use Twig\Environment;
use Illuminate\Filesystem\Filesystem;
use FosterCommerce\Groot\Container;
use FosterCommerce\Groot\Twig\Loader;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
} else {
    require __DIR__ . '/../../autoload.php';
}

$container = new Container;

$container['view'] = function ($c) {
    return new Environment(
        new Loader($c->get('paths.source')),
        ['cache' => false]
    );
};

$container['filesystem'] = function ($c) {
    return new Filesystem;
};

Container::setInstance($container);
