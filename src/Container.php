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
            'destination' => "{$path}/web/markup",
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

    /**
     * We use the array helper to allow the use of dot notation.
     *
     * @param  string  $key
     * @return mixed
     */
    public function get($key)
    {
        return Arr::get($this, $key);
    }

    /**
     * Change the instance in the container.
     *
     * We'll mostly use this in switching out implementations with mocks or
     * spies in our tests.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function instance($key, $value)
    {
        $this[$key] = $value;
    }

    /*
    |----------------------------------------------------------
    | Convenience Methods
    |----------------------------------------------------------
    */

    public function __get($key)
    {
        return $this->get($key);
    }
}
