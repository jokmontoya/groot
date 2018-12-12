<?php

namespace FosterCommerce\Groot\Providers;

use Pimple\ServiceProviderInterface as PimpleServiceProviderInterface;
use Twig\Environment;
use FosterCommerce\Groot\Twig\Loader;

class TwigServiceProvider implements PimpleServiceProviderInterface
{
    public function register($container)
    {
        $container['view'] = function ($c) {
            return new Environment(
                new Loader($c->get('paths.source')),
                ['cache' => false]
            );
        };
    }
}
