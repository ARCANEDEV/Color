<?php namespace Arcanedev\Color\Helpers;

/**
 * Class     ColorConverter
 *
 * @package  Arcanedev\Color\Helpers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorConverter
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
     * Convert a HEX color to an HSV array.
     *
     * @param  string  $hex
     *
     * @return array
     */
    public static function hexToHsv($hex)
    {
        list($red, $green, $blue) = self::hexToRgb($hex);

        return self::rgbToHsv($red, $green, $blue);
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
    public static function hsvToHex($hue, $saturation, $value)
    {
        list($red, $green, $blue) = self::hsvToRgb($hue, $saturation, $value);

        return self::rgbToHex($red, $green, $blue);
    }
}
