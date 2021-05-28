<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Config;
use BladeUI\Icons\BladeIconsServiceProvider;
use Codeat3\BladeLineAwesomeIcons\BladeLineAwesomeIconsServiceProvider;

class CompilesIconsTest extends TestCase
{
    /** @test */
    public function it_compiles_a_single_anonymous_component()
    {
        $result = svg('lineawesome-warehouse-solid')->toHtml();

        // Note: the empty class here seems to be a Blade components bug.
        $expected = <<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor"><path d="M 16 4.90625 L 3.625 10.0625 L 3 10.34375 L 3 27 L 29 27 L 29 10.34375 L 28.375 10.0625 Z M 16 7.09375 L 27 11.6875 L 27 25 L 25 25 L 25 14 L 7 14 L 7 25 L 5 25 L 5 11.6875 Z M 9 16 L 23 16 L 23 25 L 9 25 Z"/></svg>
            SVG;


        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('lineawesome-warehouse-solid', 'w-6 h-6 text-gray-500')->toHtml();
        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor"><path d="M 16 4.90625 L 3.625 10.0625 L 3 10.34375 L 3 27 L 29 27 L 29 10.34375 L 28.375 10.0625 Z M 16 7.09375 L 27 11.6875 L 27 25 L 25 25 L 25 14 L 7 14 L 7 25 L 5 25 L 5 11.6875 Z M 9 16 L 23 16 L 23 25 L 9 25 Z"/></svg>
            SVG;
        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_styles_to_icons()
    {
        $result = svg('lineawesome-warehouse-solid', ['style' => 'color: #555'])->toHtml();


        $expected = <<<'SVG'
            <svg style="color: #555" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor"><path d="M 16 4.90625 L 3.625 10.0625 L 3 10.34375 L 3 27 L 29 27 L 29 10.34375 L 28.375 10.0625 Z M 16 7.09375 L 27 11.6875 L 27 25 L 25 25 L 25 14 L 7 14 L 7 25 L 5 25 L 5 11.6875 Z M 9 16 L 23 16 L 23 25 L 9 25 Z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_default_class_from_config()
    {
        Config::set('blade-line-awesome-icons.class', 'awesome');

        $result = svg('lineawesome-warehouse-solid')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor"><path d="M 16 4.90625 L 3.625 10.0625 L 3 10.34375 L 3 27 L 29 27 L 29 10.34375 L 28.375 10.0625 Z M 16 7.09375 L 27 11.6875 L 27 25 L 25 25 L 25 14 L 7 14 L 7 25 L 5 25 L 5 11.6875 Z M 9 16 L 23 16 L 23 25 L 9 25 Z"/></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    /** @test */
    public function it_can_merge_default_class_from_config()
    {
        Config::set('blade-line-awesome-icons.class', 'awesome');

        $result = svg('lineawesome-warehouse-solid', 'w-6 h-6')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor"><path d="M 16 4.90625 L 3.625 10.0625 L 3 10.34375 L 3 27 L 29 27 L 29 10.34375 L 28.375 10.0625 Z M 16 7.09375 L 27 11.6875 L 27 25 L 25 25 L 25 14 L 7 14 L 7 25 L 5 25 L 5 11.6875 Z M 9 16 L 23 16 L 23 25 L 9 25 Z"/></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladeLineAwesomeIconsServiceProvider::class,
        ];
    }
}
