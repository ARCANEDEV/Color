<?php namespace Arcanedev\Color\Tests;

use Arcanedev\Color\Color;

/**
 * Class     Color
 *
 * @package  Arcanedev\Color\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $color = new Color;

        $expectations = [
            \Arcanedev\Color\Contracts\Color::class,
            \Arcanedev\Color\Color::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $color);
        }

        static::assertSame(0, $color->red());
        static::assertSame(0, $color->green());
        static::assertSame(0, $color->blue());
        static::assertSame(1.0, $color->alpha());
        static::assertTrue($color->isDark());
        static::assertFalse($color->isBright());
    }

    /** @test */
    public function it_can_instantiate_with_arguments()
    {
        $color = new Color(255, 255, 255);

        static::assertSame(255, $color->red());
        static::assertSame(255, $color->green());
        static::assertSame(255, $color->blue());
        static::assertSame(1.0, $color->alpha());
        static::assertFalse($color->isDark());
        static::assertTrue($color->isBright());
    }

    /** @test */
    public function it_can_make_color_instance_with_hex_value()
    {
        foreach (['#000', '#000000'] as $hex) {
            $color = Color::make($hex);

            static::assertSame(0,   $color->red());
            static::assertSame(0,   $color->green());
            static::assertSame(0,   $color->blue());
            static::assertSame(1.0, $color->alpha());
            static::assertTrue($color->isDark());
            static::assertFalse($color->isBright());
        }

        foreach (['#FFF', '#FFFFFF'] as $hex) {
            $color = Color::make($hex);

            static::assertSame(255, $color->red());
            static::assertSame(255, $color->green());
            static::assertSame(255, $color->blue());
            static::assertSame(1.0, $color->alpha());
            static::assertFalse($color->isDark());
            static::assertTrue($color->isBright());
        }
    }

    /** @test */
    public function it_can_format_to_hex()
    {
        $color = new Color(0, 0, 0);

        static::assertSame('#000000', $color->toHex());
        static::assertSame('#000000', $color->toHex(false));
        static::assertSame('#000000', (string) $color);

        $color = new Color(255, 255, 255);

        static::assertSame('#FFFFFF', $color->toHex());
        static::assertSame('#ffffff', $color->toHex(false));
        static::assertSame('#FFFFFF', (string) $color);

        $color = new Color(186, 218, 85);

        static::assertSame('#BADA55', $color->toHex());
        static::assertSame('#bada55', $color->toHex(false));
        static::assertSame('#BADA55', (string) $color);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\Color\Exceptions\ColorException
     * @expectedExceptionMessage  Invalid HEX Color [#KKK].
     */
    public function it_must_throw_an_exception_on_invalid_hex_color()
    {
        Color::make('#KKK');
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\Color\Exceptions\ColorException
     * @expectedExceptionMessage  The red value must be an integer.
     */
    public function it_must_throw_an_exception_on_invalid_rgb_color_one()
    {
        new Color(null);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\Color\Exceptions\ColorException
     * @expectedExceptionMessage  The red value must be between 0 and 255, [9000] is given.
     */
    public function it_must_throw_an_exception_on_invalid_rgb_color_two()
    {
        new Color(9000);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\Color\Exceptions\ColorException
     * @expectedExceptionMessage  The alpha value must be a float or an integer.
     */
    public function it_must_throw_an_exception_on_invalid_alpha_one()
    {
        (new Color)->setAlpha('one');
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\Color\Exceptions\ColorException
     * @expectedExceptionMessage  The alpha value must be between 0 and 1, [100] is given.
     */
    public function it_must_throw_an_exception_on_invalid_alpha_two()
    {
        (new Color)->setAlpha(100);
    }
}
