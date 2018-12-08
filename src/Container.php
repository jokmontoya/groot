<?php

namespace FosterCommerce\Groot;

use Pimple\Container as Pimple;
use Illuminate\Support\Arr;

class Container extends Pimple
{
    protected static $instance;

    public function __construct($basePath = null)
    {
        $this->setBasePath($basePath);
    }

    private function setBasePath($path)
    {
        if (! $path) {
            $path = getcwd();
        }

        $this['paths'] = [
            'base'        => $path,
            'source'      => "{$path}/app",
            'destination' => "{$path}/markup",
        ];
    }

    public static function setInstance($container)
    {
        static::$instance = $container;
    }

    public static function getInstance($key = null)
    {
        if ($key) {
            return static::$instance->get($key);
        }

        return static::$instance;
    }

    public function get($key)
    {
        return Arr::get($this, $key);
    }

    public function instance($key, $value)
    {
        $this[$key] = $value;
    }

    public function __get($key)
    {
        return $this->get($key);
    }
}
