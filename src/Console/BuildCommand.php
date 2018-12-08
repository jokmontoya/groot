<?php

namespace FosterCommerce\Groot\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Environment;
use FosterCommerce\Groot\Twig\Loader;

class BuildCommand extends Command
{
    protected static $defaultName = 'build';

    protected function configure()
    {
        $this
            ->setDescription("Compile all the twig files into static markup files.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $twig = new Environment(
            new Loader(dirname(dirname(__DIR__)) . '/app'),
            ['cache' => false]
        );

        echo $twig->render('index.twig');
    }
}
