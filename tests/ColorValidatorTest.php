<?php namespace Arcanedev\Color\Tests;

use Arcanedev\Color\ColorValidator;

/**
 * Class     ColorValidatorTest
 *
 * @package  Arcanedev\Color\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorValidatorTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_validate_hex()
    {
        $colors = [
            '#000', '#000000', '#fff', '#FFF', '#ffffff', '#FFFFFF',
            '#ff0000', '#f00', '#00ff00', '#0f0', '#0000ff', '#00f',
            '#FF0000', '#F00', '#00FF00', '#0F0', '#0000FF', '#00F',
        ];

        foreach ($colors as $color) {
            static::assertTrue(ColorValidator::validateHex($color), $color);
        }

        $colors = [
            '#0000', '#00000', '#ffff', '#FFFF', '#fffff', '#FFFFF', '#hello', '#hashtag',
            '#ff000', '#f00l', '#0ff0', '#y0l0', '#000ff', '#00ff', '#KKK', '#kkk'
        ];

        foreach ($colors as $color) {
            static::assertFalse(ColorValidator::validateHex($color), $color);
        }
    }

    /** @test */
    public function it_can_validate_rgb()
    {
        $colors = [
            'rgb(0,0,0)', 'rgb(0, 0, 0)', 'rgb( 0, 0, 0)', 'rgb( 0 , 0 , 0 )',
            'rgb(0 , 0 , 0)', 'rgb(  0  ,  0  ,  0  )',
            'rgb(255,255,255)', 'rgb(255, 255, 255)', 'rgb( 255, 255, 255)', 'rgb( 255 , 255 , 255 )',
            'rgb(255 , 255 , 255)', 'rgb(  255  ,  255  ,  255  )',
        ];

        foreach ($colors as $color) {
            static::assertTrue(ColorValidator::validateRgb($color), $color);
        }

        $colors = [
            'rgb(256,0,0)', 'rgb(0,256,0)', 'rgb(0,0,256)',
            'rgb(256, 0, 0)', 'rgb(0, 256, 0)', 'rgb(0, 0, 256)',
            'rgb( 256 , 0 , 0 )', 'rgb( 0 , 256 , 0 )', 'rgb( 0 , 0 , 256 )',
            'rgb(256,256,0)', 'rgb(256,0,256)', 'rgb(0,256,256)',
            'rgb(256, 256, 0)', 'rgb(256, 0, 256)', 'rgb(0, 256, 256)',
            'rgb( 256 , 256 , 0 )', 'rgb( 256 , 0 , 256 )', 'rgb( 0 , 256 , 256 )',
        ];

        foreach ($colors as $color) {
            static::assertFalse(ColorValidator::validateRgb($color), $color);
        }
    }

    /** @test */
    public function it_can_validate_rgba()
    {
        $colors = [
            'rgba(0,0,0,0)', 'rgba(0, 0, 0, 0)', 'rgba( 0, 0, 0, 0)', 'rgba( 0 , 0 , 0, 0 )',
            'rgba(0 , 0 , 0, 1)', 'rgba(  0  ,  0  ,  0  ,  1  )', 'rgba(0,0,0,0.1)',
            'rgba(255,255,255,1)', 'rgba(255, 255, 255, 0)', 'rgba( 255, 255, 255, 1)', 'rgba( 255 , 255 , 255 , 0 )',
            'rgba(255 , 255 , 255, 0)', 'rgba(  255  ,  255  ,  255  ,  1  )', 'rgba(255,255,255,0.2)',
        ];

        foreach ($colors as $color) {
            static::assertTrue(ColorValidator::validateRgba($color), $color);
        }

        $colors = [
            'rgba(256,0,0,1)', 'rgba(0,256,0,0)', 'rgba(0,0,256,1)',
            'rgba(256, 0, 0, 0)', 'rgba(0, 256, 0, 1)', 'rgba(0, 0, 256, 0)',
            'rgba( 256 , 0 , 0 , 1)', 'rgba( 0 , 256 , 0 , 0)', 'rgba( 0 , 0 , 256 , 1)',
            'rgba(256,256,0,0)', 'rgba(256,0,256,1)', 'rgba(0,256,256,0)',
            'rgba(256, 256, 0, 0.1)', 'rgba(256, 0, 256, 0.2)', 'rgba(0, 256, 256, 0.3)',
            'rgba( 256 , 256 , 0 , 0.4)', 'rgba( 256 , 0 , 256 , 0.5)', 'rgba( 0 , 256 , 256 , 0.6)',
        ];

        foreach ($colors as $color) {
            static::assertFalse(ColorValidator::validateRgba($color), $color);
        }
    }

    /** @test */
    public function it_can_validate_hsl()
    {
        $colors = [
            'hsl(0, 0%, 0%)', 'hsl(359, 0%, 0%)', 'hsl(0, 100%, 0%)', 'hsl(359, 100%, 0%)',
            'hsl(0, 0%, 100%)', 'hsl(359, 0%, 100%)', 'hsl(0, 100%, 100%)', 'hsl(359, 100%, 100%)',
            'hsl(0, 100%, 100%)', 'hsl(120, 100%, 100%)', 'hsl(240, 100%, 100%)',
        ];

        foreach ($colors as $color) {
            static::assertTrue(ColorValidator::validateHsl($color), $color);
        }

        $colors = [
            'hsl(360, 0%, 0%)', 'hsl(0, 200%, 0%)', 'hsl(0, 0, 0)', 'hsl(0, 0%, 200%)',
            'hsl(0, 0%, 100)', 'hsl(359, 0, 100%)', 'hsl(0, 200%, 200%)',
        ];

        foreach ($colors as $color) {
            static::assertFalse(ColorValidator::validateHsl($color), $color);
        }
    }

    /** @test */
    public function it_can_validate_hsla()
    {
        $colors = [
            'hsla(0, 0%, 0%, 0)', 'hsla(359, 0%, 0%, 1)', 'hsla(0, 100%, 0%, 0)', 'hsla(359, 100%, 0%, 1)',
            'hsla(0, 0%, 100%, 0)', 'hsla(359, 0%, 100%, 1)', 'hsla(0, 100%, 100%, 0)', 'hsla(359, 100%, 100%, 1)',
            'hsla(0, 100%, 100%, 1)', 'hsla(120, 100%, 100%, 1)', 'hsla(240, 100%, 100%, 1)',
            'hsla(0, 100%, 100%, 0.1)', 'hsla(120, 100%, 100%, 0.2)', 'hsla(240, 100%, 100%, 0.3)',
            'hsla(0, 100%, 100%, 0.4)', 'hsla(120, 100%, 100%, 0.5)', 'hsla(240, 100%, 100%, 0.6)',
            'hsla(0, 100%, 100%, 0.7)', 'hsla(120, 100%, 100%, 0.8)', 'hsla(240, 100%, 100%, 0.9)',
        ];

        foreach ($colors as $color) {
            static::assertTrue(ColorValidator::validateHsla($color), $color);
        }

        $colors = [
            'hsla(360, 0%, 0%, 1)', 'hsla(0, 200%, 0%, 0)', 'hsla(0, 0, 0, 1)', 'hsla(0, 0%, 200%, 0)',
            'hsla(0, 0%, 100, 1)', 'hsla(359, 0, 100%, 0)', 'hsla(0, 200%, 200%, 1)',
        ];

        foreach ($colors as $color) {
            static::assertFalse(ColorValidator::validateHsla($color), $color);
        }
    }
}
