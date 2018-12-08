<?php

namespace FosterCommerce\Groot\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
        echo 'test';
    }
}
