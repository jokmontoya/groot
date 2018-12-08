<?php

namespace FosterCommerce\Groot;

use Twig\Environment;
use Illuminate\Filesystem\Filesystem;
use FosterCommerce\Groot\Twig\Loader;
use FosterCommerce\Groot\Container;

trait RendersView
{
    public function compiledPathname()
    {
        return str_replace('.twig', '.html', $this->getRelativePathname());
    }

    /**
     * Render the view.
     *
     * We're using nullable parameters here just for mocking purposes in testing.
     * Just a quick hack before using a vfs.
     */
    public function render()
    {
        if ($this->file->getRelativePath() && ! $this->directoryExists()) {
             $this->createDirectory();
        }

        app('filesystem')->put(
            app('paths.destination') . '/' . $this->compiledPathname(),
            app('view')->render($this->getRelativePathname())
        );
    }

    public function createDirectory()
    {
        app('filesystem')->makeDirectory(
            app('paths.destination') . '/' . $this->file->getRelativePath(),
            $permissions = 0755,
            $recursive = true
        );
    }
}
