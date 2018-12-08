<?php

namespace FosterCommerce\Groot\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Environment;
use FosterCommerce\Groot\Twig\Loader;
use FosterCommerce\Groot\FileCollection;
use FosterCommerce\Groot\File;

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
        $path = dirname(dirname(__DIR__)) . '/app';

        $twig = new Environment(new Loader($path), [
            'cache' => false,
        ]);

        $files = FileCollection::directory($path)
               ->map(function ($file) use ($path) {
                   return new File($file, $path);
               })
               ->rejectPartials()
               ->expand();

        var_dump($files->map->path());
    }
}
