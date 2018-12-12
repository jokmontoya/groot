<?php

namespace FosterCommerce\Groot\Providers;

use Pimple\ServiceProviderInterface as PimpleServiceProviderInterface;
use Illuminate\Filesystem\Filesystem;

class FilesystemServiceProvider implements PimpleServiceProviderInterface
{
    public function register($container)
    {
        $container['filesystem'] = function ($c) {
            return new Filesystem;
        };
    }
}
