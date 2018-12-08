<?php

namespace FosterCommerce\Groot\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NewCommand extends Command
{
    protected static $defaultName = 'new';

    protected function configure()
    {
        $this
            ->setDescription("Create a new groot project")
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the project.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $site = __DIR__ . '/../../stub';

        $destination = getcwd() . '/' . $name;

        if (file_exists($destination)) {
            $output->writeln('The folder already exists! Aborting.');

            return;
        }

        (new \Illuminate\Filesystem\Filesystem)->copyDirectory($site, $destination);

        $output->writeln("Project ${name} created!");
    }
}
