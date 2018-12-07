<?php

namespace Tests;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class ExampleTest extends TestCase
{
    function test_something()
    {
        $twig = new Environment(
            new FilesystemLoader(__DIR__ . '/templates'),
            ['cache' => false]
        );

        echo $twig->render('index.twig');
    }
}
