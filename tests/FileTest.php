<?php

namespace Tests;

use Tests\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Mockery;
use Symfony\Component\Finder\SplFileInfo;
use FosterCommerce\Groot\File;

class FileTest extends TestCase
{
    function setup()
    {
        parent::setup();

        $this->root = vfsStream::setup('groot', null, [
            'app' => [
                'index.twig' => 'Some Content',

                'first' => [
                    'second' => [
                        'file.twig' => 'Nested File',
                    ]
                ],
            ],
            'markup' => [],
        ]);

        app()->instance('paths', [
            'base'        => $base = vfsStream::url('groot'),
            'source'      => $base . '/app',
            'destination' => $base . '/markup',
        ]);
    }

    function test_is_renderable()
    {
        $file = $this->newFile('index.twig', '_layouts', '_layouts/index.twig');
        $this->assertFalse($file->isView());

        $file = $this->newFile('index.twig', 'posts', 'posts/index.twig');
        $this->assertTrue($file->isView());

        $file = $this->newFile('_index.twig', 'posts', 'posts/_index.twig');
        $this->assertFalse($file->isView());
    }

    function test_compile_to_twig()
    {
         $this
             ->newFile('index.twig', '', 'index.twig')
             ->render();

        $this->assertTrue(
            $this->root->hasChild('markup/index.html')
        );
    }

    function test_create_the_parent_directory()
    {
        $this
            ->newFile('file.twig', 'first/second', 'first/second/file.twig')
            ->render();

        $this->assertTrue(
            $this->root->hasChild('markup/first/second/file.html')
        );
    }

    private function newFile($file, $relativePath, $relativePathname)
    {
        return new File(new SplFileInfo($file, $relativePath, $relativePathname));
    }
}
