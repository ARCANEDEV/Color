<?php namespace Arcanedev\Color\Converters;

/**
 * Trait     HEXTrait
 *
 * @package  Arcanedev\Color\Converters
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HEXTrait
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Convert a HEX color to an RGB array (alias).
     *
     * @see    fromHexToRgb
     *
     * @param  string  $hex
     *
     * @return array
     */
    public static function hexToRgb($hex)
    {
        return (new self)->fromHexToRgb($hex);
    }

    /**
     * Convert a HEX color to an RGB array.
     *
     * @param  string  $hex
     *
     * @return array
     */
    public function fromHexToRgb($hex)
    {
        $value = str_replace('#', '', $hex);

        return array_map('hexdec', strlen($value) === 6 ? [
            substr($value, 0, 2), // RED
            substr($value, 2, 2), // GREEN
            substr($value, 4, 2), // BLUE
        ] : [
            str_repeat(substr($value, 0, 1), 2), // RED
            str_repeat(substr($value, 1, 1), 2), // GREEN
            str_repeat(substr($value, 2, 1), 2), // BLUE
        ]);
    }

    /**
     * Convert RGB values to a HEX color (alias).
     *
     * @see    fromRgbToHex
     *
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return string
     */
    public static function rgbToHex($red, $green, $blue)
    {
        return (new self)->fromRgbToHex($red, $green, $blue);
    }

    /**
     * Convert RGB values to a HEX color.
     *
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return string
     */
    public function fromRgbToHex($red, $green, $blue)
    {
        return '#' . implode('', array_map(function ($value) {
            return str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
        }, [$red, $green, $blue]));
    }
}
