<?php

namespace FosterCommerce\Groot;

use Illuminate\Support\Str;

class File
{
    use RendersView;

    /**
     * All files and folders that are prefixed with an underscore will be
     * ignored when the compiler is ran.
     */
    const PARTIAL_PREFIX = '_';

    const SOURCE = 'app';

    const DESTINATION = 'markup';

    /**
     * The Symfony file instance.
     *
     * @var \Symfony\Component\Finder\SpfFileInfo
     */
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Check if the fill is going to be compiled when the build command is ran.
     *
     * This also checks if the parent directory is prefixed or now.
     *
     * @return bool
     */
    public function isView()
    {
        return
            ! Str::startsWith($this->file->getRelativePathname(), static::PARTIAL_PREFIX) &&
            ! Str::startsWith($this->file->getFilename(), static::PARTIAL_PREFIX);
    }

    public function __call($method, $arguments = [])
    {
        return call_user_func_array([$this->file, $method], $arguments);
    }
}
