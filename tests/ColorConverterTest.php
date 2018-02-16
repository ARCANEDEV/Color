<?php namespace Arcanedev\Color\Tests;

use Arcanedev\Color\ColorConverter;

/**
 * Class     ColorConverterTest
 *
 * @package  Arcanedev\Color\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorConverterTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\Color\ColorConverter */
    protected $converter;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp()
    {
        parent::setUp();

        $this->converter = new ColorConverter;
    }

    protected function tearDown()
    {
        unset($this->converter);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_convert_from_rgb_to_hex()
    {
        static::assertSame('#000000', ColorConverter::rgbToHex(0, 0, 0));
        static::assertSame('#000000', $this->converter->fromRgbToHex(0, 0, 0));

        static::assertSame('#ffffff', ColorConverter::rgbToHex(255, 255, 255));
        static::assertSame('#ffffff', $this->converter->fromRgbToHex(255, 255, 255));

        static::assertSame('#bada55', ColorConverter::rgbToHex(186, 218, 85));
        static::assertSame('#bada55', $this->converter->fromRgbToHex(186, 218, 85));
    }

    /** @test */
    public function it_can_convert_from_rgb_to_hsv()
    {
        static::assertSame(
            [0.0, 0.0, 0.0],
            ColorConverter::rgbToHsv(0, 0, 0)
        );
        static::assertSame(
            [0.0, 0.0, 0.0],
            $this->converter->fromRgbToHsv(0, 0, 0)
        );

        static::assertSame(
            [180.0, 100.0, 100.0],
            ColorConverter::rgbToHsv(0, 255, 255)
        );

        static::assertSame(
            [180.0, 100.0, 100.0],
            $this->converter->fromRgbToHsv(0, 255, 255)
        );

        static::assertSame(
            [300.0, 100.0, 100.0],
            ColorConverter::rgbToHsv(255, 0, 255)
        );

        static::assertSame(
            [300.0, 100.0, 100.0],
            $this->converter->fromRgbToHsv(255, 0, 255)
        );

        static::assertSame(
            [60.0, 100.0, 100.0],
            ColorConverter::rgbToHsv(255, 255, 0)
        );

        static::assertSame(
            [60.0, 100.0, 100.0],
            $this->converter->fromRgbToHsv(255, 255, 0)
        );

        static::assertSame(
            [0.0, 0.0, 100.0],
            ColorConverter::rgbToHsv(255, 255, 255)
        );

        static::assertSame(
            [0.0, 0.0, 100.0],
            $this->converter->fromRgbToHsv(255, 255, 255)
        );

        static::assertSame(
            [74.44, 61.01, 85.49],
            ColorConverter::rgbToHsv(186, 218, 85)
        );

        static::assertSame(
            [74.44, 61.01, 85.49],
            $this->converter->fromRgbToHsv(186, 218, 85)
        );
    }

    /** @test */
    public function it_can_convert_from_hex_to_rgb()
    {
        $expected = [
            186, // Red
            218, // Green
            85,  // Blue
        ];

        foreach (['#bada55', '#BADA55'] as $hex) {
            static::assertSame($expected, ColorConverter::hexToRgb($hex));
            static::assertSame($expected, $this->converter->fromHexToRgb($hex));
        }
    }

    /** @test */
    public function it_can_convert_from_hex_to_hsv()
    {
        $expected = [
            74.44, // Hue
            61.01, // Saturation
            85.49, // Value
        ];

        foreach (['#bada55', '#BADA55'] as $hex) {
            static::assertSame($expected, ColorConverter::hexToHsv($hex));
            static::assertSame($expected, $this->converter->fromHexToHsv($hex));
        }
    }

    /** @test */
    public function it_can_convert_from_hsv_to_hex()
    {
        static::assertSame('#bada55', ColorConverter::hsvToHex(74.44, 61.01, 85.49));
        static::assertSame('#bada55', $this->converter->fromHsvToHex(74.44, 61.01, 85.49));
    }

    /** @test */
    public function it_can_convert_from_hsv_to_rgb()
    {
        static::assertSame(
            [0, 0, 0],
            ColorConverter::hsvToRgb(0.0, 0.0, 0.0)
        );
        static::assertSame(
            [0, 0, 0],
            $this->converter->fromHsvToRgb(0.0, 0.0, 0.0)
        );

        static::assertSame(
            [0, 255, 255],
            ColorConverter::hsvToRgb(180.0, 100.0, 100.0)
        );

        static::assertSame(
            [0, 255, 255],
            $this->converter->fromHsvToRgb(180.0, 100.0, 100.0)
        );

        static::assertSame(
            [255, 0, 255],
            ColorConverter::hsvToRgb(300.0, 100.0, 100.0)
        );

        static::assertSame(
            [255, 0, 255],
            $this->converter->fromHsvToRgb(300.0, 100.0, 100.0)
        );

        static::assertSame(
            [255, 255, 0],
            ColorConverter::hsvToRgb(60.0, 100.0, 100.0)
        );

        static::assertSame(
            [255, 255, 0],
            $this->converter->fromHsvToRgb(60.0, 100.0, 100.0)
        );

        static::assertSame(
            [255, 255, 255],
            ColorConverter::hsvToRgb(0.0, 0.0, 100.0)
        );

        static::assertSame(
            [255, 255, 255],
            $this->converter->fromHsvToRgb(0.0, 0.0, 100.0)
        );

        static::assertSame(
            [186, 218, 85],
            ColorConverter::hsvToRgb(74.44, 61.01, 85.49)
        );

        static::assertSame(
            [186, 218, 85],
            $this->converter->fromHsvToRgb(74.44, 61.01, 85.49)
        );
    }
}
