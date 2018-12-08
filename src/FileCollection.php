<?php

namespace FosterCommerce\Groot;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;

class FileCollection extends Collection
{
    const SOURCE = 'app';

    public static function fromSource()
    {
        $files = (new Filesystem)->allFiles(getcwd() . '/' . static::SOURCE);

        return (new static($files))->mapInto(File::class);
    }

    public function filterViews()
    {
        return $this->filter->isView();
    }

    public function render()
    {
        return $this->each->render();
    }
}
