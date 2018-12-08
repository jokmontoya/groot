<?php

namespace FosterCommerce\Groot;

use Illuminate\Support\Str;

class File
{
    const PARTIAL_PREFIX = '_';

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function isPartial()
    {
        return Str::startsWith(
            $this->file->getRelativePathname(),
            static::PARTIAL_PREFIX
        );
    }

    public function __call($method, $arguments = [])
    {
        return call_user_func_array([$this->file, $method], $arguments);
    }
}
