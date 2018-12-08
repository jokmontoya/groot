<?php

namespace Tests;

use Tests\TestCase;
use Symfony\Component\Finder\SplFileInfo;
use FosterCommerce\Groot\File;

class FileTest extends TestCase
{
    function test_is_partial()
    {
        $partial = $this->newFile('index.twig', '_layouts', '_layouts/index.twig');
        $this->assertTrue($partial->isPartial());

        $file = $this->newFile('index.twig', 'posts', 'posts/index.twig');
        $this->assertFalse($file->isPartial());
    }

    private function newFile($file, $relativePath, $relativePathname)
    {
        return new File(new SplFileInfo($file, $relativePath, $relativePathname));
    }
}
