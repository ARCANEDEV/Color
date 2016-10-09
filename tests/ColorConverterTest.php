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
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Arcanedev\Color\ColorConverter */
    protected $converter;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
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



    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_convert_from_rgb_to_hex()
    {
        $this->assertSame('#000000', ColorConverter::rgbToHex(0, 0, 0));
        $this->assertSame('#000000', $this->converter->fromRgbToHex(0, 0, 0));

        $this->assertSame('#ffffff', ColorConverter::rgbToHex(255, 255, 255));
        $this->assertSame('#ffffff', $this->converter->fromRgbToHex(255, 255, 255));

        $this->assertSame('#bada55', ColorConverter::rgbToHex(186, 218, 85));
        $this->assertSame('#bada55', $this->converter->fromRgbToHex(186, 218, 85));
    }

    /** @test */
    public function it_can_convert_from_rgb_to_hsv()
    {
        $this->assertSame(
            [0.0, 0.0, 0.0],
            ColorConverter::rgbToHsv(0, 0, 0)
        );
        $this->assertSame(
            [0.0, 0.0, 0.0],
            $this->converter->fromRgbToHsv(0, 0, 0)
        );

        $this->assertSame(
            [180.0, 100.0, 100.0],
            ColorConverter::rgbToHsv(0, 255, 255)
        );

        $this->assertSame(
            [180.0, 100.0, 100.0],
            $this->converter->fromRgbToHsv(0, 255, 255)
        );

        $this->assertSame(
            [300.0, 100.0, 100.0],
            ColorConverter::rgbToHsv(255, 0, 255)
        );

        $this->assertSame(
            [300.0, 100.0, 100.0],
            $this->converter->fromRgbToHsv(255, 0, 255)
        );

        $this->assertSame(
            [60.0, 100.0, 100.0],
            ColorConverter::rgbToHsv(255, 255, 0)
        );

        $this->assertSame(
            [60.0, 100.0, 100.0],
            $this->converter->fromRgbToHsv(255, 255, 0)
        );

        $this->assertSame(
            [0.0, 0.0, 100.0],
            ColorConverter::rgbToHsv(255, 255, 255)
        );

        $this->assertSame(
            [0.0, 0.0, 100.0],
            $this->converter->fromRgbToHsv(255, 255, 255)
        );

        $this->assertSame(
            [74.44, 61.01, 85.49],
            ColorConverter::rgbToHsv(186, 218, 85)
        );

        $this->assertSame(
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
            $this->assertSame($expected, ColorConverter::hexToRgb($hex));
            $this->assertSame($expected, $this->converter->fromHexToRgb($hex));
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
            $this->assertSame($expected, ColorConverter::hexToHsv($hex));
            $this->assertSame($expected, $this->converter->fromHexToHsv($hex));
        }
    }

    /** @test */
    public function it_can_convert_from_hsv_to_hex()
    {
        $this->assertSame('#bada55', ColorConverter::hsvToHex(74.44, 61.01, 85.49));
        $this->assertSame('#bada55', $this->converter->fromHsvToHex(74.44, 61.01, 85.49));
    }

    /** @test */
    public function it_can_convert_from_hsv_to_rgb()
    {
        $this->assertSame(
            [0, 0, 0],
            ColorConverter::hsvToRgb(0.0, 0.0, 0.0)
        );
        $this->assertSame(
            [0, 0, 0],
            $this->converter->fromHsvToRgb(0.0, 0.0, 0.0)
        );

        $this->assertSame(
            [0, 255, 255],
            ColorConverter::hsvToRgb(180.0, 100.0, 100.0)
        );

        $this->assertSame(
            [0, 255, 255],
            $this->converter->fromHsvToRgb(180.0, 100.0, 100.0)
        );

        $this->assertSame(
            [255, 0, 255],
            ColorConverter::hsvToRgb(300.0, 100.0, 100.0)
        );

        $this->assertSame(
            [255, 0, 255],
            $this->converter->fromHsvToRgb(300.0, 100.0, 100.0)
        );

        $this->assertSame(
            [255, 255, 0],
            ColorConverter::hsvToRgb(60.0, 100.0, 100.0)
        );

        $this->assertSame(
            [255, 255, 0],
            $this->converter->fromHsvToRgb(60.0, 100.0, 100.0)
        );

        $this->assertSame(
            [255, 255, 255],
            ColorConverter::hsvToRgb(0.0, 0.0, 100.0)
        );

        $this->assertSame(
            [255, 255, 255],
            $this->converter->fromHsvToRgb(0.0, 0.0, 100.0)
        );

        $this->assertSame(
            [186, 218, 85],
            ColorConverter::hsvToRgb(74.44, 61.01, 85.49)
        );

        $this->assertSame(
            [186, 218, 85],
            $this->converter->fromHsvToRgb(74.44, 61.01, 85.49)
        );
    }
}
