<?php

namespace FosterCommerce\Groot;

use Twig\Environment;
use Illuminate\Support\Str;
use FosterCommerce\Groot\Twig\Loader;
use FosterCommerce\Groot\Container;

trait RendersView
{
    private function destinationPath($path = null)
    {
        return app('paths.destination') . '/' . $this->file->getRelativePath();
    }

    public function destinationPathname()
    {
        return app('paths.destination') . '/' . str_replace('.twig', '.html', $this->getRelativePathname());
    }

    public function sourcePathname()
    {
        return $this->file->getRelativePathname();
    }

    public function render()
    {
        $this->createDirectory();

        $markup = app('view')->render($this->sourcePathname());

        app('filesystem')->put($this->destinationPathname(), $markup);
    }

    public function createDirectory()
    {
        if (! $this->file->getRelativePath() || file_exists($this->destinationPath())) {
            return;
        }

        app('filesystem')->makeDirectory(
            $this->destinationPath(),
            $permissions = 0755,
            $recursive = true
        );
    }
}
