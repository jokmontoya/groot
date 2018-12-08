<?php

namespace FosterCommerce\Groot;

use Illuminate\Support\Str;

class File
{
    const PARTIAL_PREFIX = '_';

    public function __construct($name, $directory)
    {
        $this->name = $name;
        $this->directory = $directory;
    }

    public function isPartial()
    {
        return Str::startsWith($this->name, static::PARTIAL_PREFIX);
    }

    public function isDirectory()
    {
        return is_dir($this->path());
    }

    public function files()
    {
        return FileCollection::directory(
            $this->directory . '/' . $this->name
        )->map(function ($file) {
            return new static($file, $this->path());
        })->expand();
    }

    public function path()
    {
        return $this->directory . '/' . $this->name;
    }
}
