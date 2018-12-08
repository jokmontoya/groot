<?php

namespace FosterCommerce\Groot;

use Illuminate\Support\Collection;

class FileCollection extends Collection
{
    public static function directory($directory)
    {
        return new static(
            Collection::make(scandir($directory))->diff(['.', '..'])
        );
    }

    public function rejectPartials()
    {
        return $this->reject->isPartial();
    }

    public function expand()
    {
        return $this->map(function ($file) {
            if ($file->isDirectory()) {
                return $file->files();
            }

            return $file;
        })->flatten();
    }
}
