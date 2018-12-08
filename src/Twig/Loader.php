<?php

namespace FosterCommerce\Groot\Twig;

use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;

class Loader extends TwigFilesystemLoader
{
    protected function findTemplate($name, $throw = true)
    {
        try {
            return parent::findTemplate($name, $throw);
        } catch(\Exception $e) {
            return parent::findTemplate($this->normalizeName($name), $throw);
        }
    }

    /**
     * Check for dot notations in the template names.
     *
     * It's a bit cleaner than having to always append .twig or use slashes.
     *
     * @param  string  $name
     * @return string
     */
    private function normalizeName($name)
    {
        return str_replace('.', '/', $name) . '.twig';
    }
}
