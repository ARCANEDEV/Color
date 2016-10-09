<?php namespace Arcanedev\Color;

use Arcanedev\Color\Contracts\ColorConverter as ColorConverterContract;

/**
 * Class     ColorConverter
 *
 * @package  Arcanedev\Color
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorConverter implements ColorConverterContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Traits
     | ------------------------------------------------------------------------------------------------
     */
    use Converters\HEXTrait,
        Converters\HSVTrait;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Convert a HEX color to an HSV array (alias).
     *
     * @see    fromHexToHsv
     *
     * @param  string  $hex
     *
     * @return array
     */
    public static function hexToHsv($hex)
    {
        return (new self)->fromHexToHsv($hex);
    }

    /**
     * Convert a HEX color to an HSV array.
     *
     * @param  string  $hex
     *
     * @return array
     */
    public function fromHexToHsv($hex)
    {
        list($red, $green, $blue) = $this->fromHexToRgb($hex);

        return $this->fromRgbToHsv($red, $green, $blue);
    }

    /**
     * Convert an HSV to HEX color (alias).
     *
     * @see    fromHsvToHex
     *
     * @param  float|int  $hue
     * @param  float|int  $saturation
     * @param  float|int  $value
     *
     * @return array
     */
    public static function hsvToHex($hue, $saturation, $value)
    {
        return (new self)->fromHsvToHex($hue, $saturation, $value);
    }

    /**
     * Convert an HSV to HEX color.
     *
     * @param  float|int  $hue
     * @param  float|int  $saturation
     * @param  float|int  $value
     *
     * @return array
     */
    public function fromHsvToHex($hue, $saturation, $value)
    {
        list($red, $green, $blue) = $this->fromHsvToRgb($hue, $saturation, $value);

        return $this->fromRgbToHex($red, $green, $blue);
    }
}
