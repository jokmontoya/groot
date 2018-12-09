<?php

namespace FosterCommerce\Groot;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;

class FileCollection extends Collection
{
    public static function fromSource()
    {
        $files = app('filesystem')->allFiles(app('paths.source'));

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
