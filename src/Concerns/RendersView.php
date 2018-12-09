<?php

namespace FosterCommerce\Groot\Concerns;

trait RendersView
{
    public function render()
    {
        $this->ensureDestinationExists();

        app('filesystem')->put(
            $this->destinationPathname(),
            app('view')->render($this->sourcePathname())
        );
    }

    private function destinationPath($path = null)
    {
        return app('paths.destination') . '/' . $this->getRelativePath();
    }

    private function destinationPathname()
    {
        $html = str_replace('.twig', '.html', $this->getRelativePathname());

        return app('paths.destination') . '/' . $html;
    }

    private function sourcePathname()
    {
        return $this->getRelativePathname();
    }

    private function ensureDestinationExists()
    {
        if (! $this->getRelativePath() || file_exists($this->destinationPath())) {
            return;
        }

        app('filesystem')->makeDirectory(
            $this->destinationPath(),
            0755,
            $recursive = true
        );
    }
}
