<?php namespace Arcanedev\Color\Contracts;

/**
 * Interface  ColorValidator
 *
 * @package   Arcanedev\Color\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface ColorValidator
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if the color is valid HEX Color.
     *
     * @param  string  $hex
     *
     * @return bool
     */
    public static function validateHex($hex);

    /**
     * Check if the color is valid RGB Color.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public static function validateRgb($value);

    /**
     * Check if the color is valid RGBA Color.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public static function validateRgba($value);

    /**
     * Check if the color is valid HSL Color.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public static function validateHsl($value);

    /**
     * Check if the color is valid HSLA Color.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public static function validateHsla($value);
}
