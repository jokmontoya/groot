<?php

namespace FosterCommerce\Groot;

use Twig\Environment;
use Illuminate\Filesystem\Filesystem;
use FosterCommerce\Groot\Twig\Loader;

trait RendersView
{
    /**
     * The templating engine to render the file.
     *
     * @var
     */
    private $engine;

    /**
     * We don't need to cache the views since we're rendering manually.
     *
     * @return Environment
     */
    private function engine()
    {
        $path = getcwd() . '/' . FileCollection::SOURCE;

        return new Environment(new Loader($path), [
            'cache' => false
        ]);
    }

    private function filesystem()
    {
        return new Filesystem;
    }

    public function compiledPathname()
    {
        return str_replace('.twig', '.html', $this->getRelativePathname());
    }

    /**
     * Render the view.
     *
     * We're using nullable parameters here just for mocking purposes in testing.
     * Just a quick hack before using a vfs.
     *
     * @param  \Twig\Environment  $engine
     * @param  \Illuminate\Filesystem\Filesystem  $filesystem
     * @return void
     */
    public function render($engine = null, $filesystem = null)
    {
        if (! $engine) {
            $engine = $this->engine();
        }

        if (! $filesystem) {
            $filesystem = $this->filesystem();
        }

        if ($this->file->getRelativePath() && ! $this->directoryExists()) {
            $this->createDirectory();
        }

        $filesystem->put(
            getcwd() . '/' . static::DESTINATION . '/' . $this->compiledPathname(),
            $engine->render($this->getRelativePathname())
        );
    }

    public function createDirectory()
    {
        $this->filesystem()->makeDirectory(
            getcwd() . '/' . static::DESTINATION . '/' . $this->file->getRelativePath(),
            $permissions = 0755,
            $recursive = true
        );
    }
}
