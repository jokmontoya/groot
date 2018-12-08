<?php

use FosterCommerce\Groot\Container;

if (! function_exists('app')) {
    function app($key = null)
    {
        return Container::getInstance($key);
    }
}
