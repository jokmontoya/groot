<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use FosterCommerce\Groot\Container;

class TestCase extends BaseTestCase
{
    public function setup()
    {
        parent::setup();

        Container::setInstance(new Container);
    }
}
