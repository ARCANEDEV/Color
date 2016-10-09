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
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
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
            $this->assertInstanceOf($expected, $color);
        }

        $this->assertSame(0, $color->red());
        $this->assertSame(0, $color->green());
        $this->assertSame(0, $color->blue());
        $this->assertTrue($color->isDark());
        $this->assertFalse($color->isBright());
    }

    /** @test */
    public function it_can_instantiate_with_arguments()
    {
        $color = new Color(255, 255, 255);

        $this->assertSame(255, $color->red());
        $this->assertSame(255, $color->green());
        $this->assertSame(255, $color->blue());
        $this->assertFalse($color->isDark());
        $this->assertTrue($color->isBright());
    }

    /** @test */
    public function it_can_make_color_instance_with_hex_value()
    {
        foreach (['#000', '#000000'] as $hex) {
            $color = Color::make($hex);

            $this->assertSame(0, $color->red());
            $this->assertSame(0, $color->green());
            $this->assertSame(0, $color->blue());
            $this->assertTrue($color->isDark());
            $this->assertFalse($color->isBright());
        }

        foreach (['#FFF', '#FFFFFF'] as $hex) {
            $color = Color::make($hex);

            $this->assertSame(255, $color->red());
            $this->assertSame(255, $color->green());
            $this->assertSame(255, $color->blue());
            $this->assertFalse($color->isDark());
            $this->assertTrue($color->isBright());
        }
    }

    /** @test */
    public function it_can_format_to_hex()
    {
        $color = new Color(0, 0, 0);

        $this->assertSame('#000000', $color->toHex());
        $this->assertSame('#000000', $color->toHex(false));
        $this->assertSame('#000000', (string) $color);

        $color = new Color(255, 255, 255);

        $this->assertSame('#FFFFFF', $color->toHex());
        $this->assertSame('#ffffff', $color->toHex(false));
        $this->assertSame('#FFFFFF', (string) $color);
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
     * @expectedExceptionMessage  The color value must be an integer.
     */
    public function it_must_throw_an_exception_on_invalid_rgb_color_one()
    {
        new Color(null);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\Color\Exceptions\ColorException
     * @expectedExceptionMessage  The color value must be between 0 and 255, [9000] is given.
     */
    public function it_must_throw_an_exception_on_invalid_rgb_color_two()
    {
        new Color(9000);
    }
}
