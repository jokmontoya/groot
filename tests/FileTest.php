<?php

namespace Tests;

use Tests\TestCase;
use Mockery;
use Symfony\Component\Finder\SplFileInfo;
use FosterCommerce\Groot\File;

class FileTest extends TestCase
{
    function test_is_renderable()
    {
        $file = $this->newFile('index.twig', '_layouts', '_layouts/index.twig');
        $this->assertFalse($file->isView());

        $file = $this->newFile('index.twig', 'posts', 'posts/index.twig');
        $this->assertTrue($file->isView());

        $file = $this->newFile('_index.twig', 'posts', 'posts/_index.twig');
        $this->assertFalse($file->isView());
    }

    function test_compiled_pathname()
    {
        $file = $this->newFile('index.twig', 'posts', 'posts/index.twig');

        $this->assertEquals($file->compiledPathname(), 'posts/index.html');
    }

    function test_compile_to_twig()
    {
        $engine = Mockery::spy(\Twig\Environment::class);
        $filesystem = Mockery::spy(\Illuminate\Filesystem\Filesystem::class);

        $file = $this->newFile('index.twig', 'posts', 'posts/index.twig');
        $file->render($engine, $filesystem);

        $engine
            ->shouldHaveReceived('render')
            ->with('posts/index.html')
            ->once();

        $filesystem
            ->shouldHaveReceived('put')
            ->once();

        // We can just this for now. We can use a virtual filesystem later to
        // do proper integration testing rather than mocking everything.
        $this->assertTrue(true);
    }

    private function newFile($file, $relativePath, $relativePathname)
    {
        return new File(new SplFileInfo($file, $relativePath, $relativePathname));
    }
}
