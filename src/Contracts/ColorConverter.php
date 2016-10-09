<?php namespace Arcanedev\Color\Contracts;

/**
 * Interface  ColorConverter
 *
 * @package   Arcanedev\Color\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface ColorConverter
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Convert a HEX color to an RGB array.
     *
     * @param  string  $hex
     *
     * @return array
     */
    public static function hexToRgb($hex);

    /**
     * Convert RGB values to a HEX color.
     *
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return string
     */
    public static function rgbToHex($red, $green, $blue);

    /**
     * Convert an RGB color to an HSV array.
     *
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return array
     */
    public static function rgbToHsv($red, $green, $blue);

    /**
     * Convert an HSV color to an RGB array.
     *
     * @param  float|int  $hue
     * @param  float|int  $saturation
     * @param  float|int  $value
     *
     * @return array
     */
    public static function hsvToRgb($hue, $saturation, $value);

    /**
     * Convert a HEX color to an HSV array.
     *
     * @param  string  $hex
     *
     * @return array
     */
    public static function hexToHsv($hex);

    /**
     * Convert an HSV to HEX color.
     *
     * @param  float|int  $hue
     * @param  float|int  $saturation
     * @param  float|int  $value
     *
     * @return array
     */
    public static function hsvToHex($hue, $saturation, $value);
}
