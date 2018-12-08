<?php

namespace FosterCommerce\Groot\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Environment;
use FosterCommerce\Groot\Twig\Loader;
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
        $destination = getcwd() . '/markup';
        $path = dirname(dirname(__DIR__)) . '/app';

        $twig = new Environment(new Loader($path), [
            'cache' => false,
        ]);

        $files = collect((new \Illuminate\Filesystem\Filesystem)->allFiles($path))
            ->map(function ($file) {
                return new File($file);
            })

            ->reject->isPartial()

            ->each(function ($file) use ($destination) {
                if (! $file->getRelativePath()) {
                    return;
                }

                if (file_exists($destination . '/' . $file->getRelativePath())) {
                    return;
                }

                mkdir($destination . '/' . $file->getRelativePath(), 0777, $recursive = true);
            })

            ->each(function ($file) use ($destination, $twig) {
                $markup = $twig->render(
                    $file->getRelativePathname()
                );

                file_put_contents(
                    $destination . '/' . $file->getMarkupFilename(),
                    $markup
                );
            });
    }
}
