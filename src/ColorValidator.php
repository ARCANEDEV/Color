<?php namespace Arcanedev\Color;

use Arcanedev\Color\Contracts\ColorValidator as ColorValidatorContract;

/**
 * Class     ColorValidator
 *
 * @package  Arcanedev\Color
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorValidator implements ColorValidatorContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Constants
     | ------------------------------------------------------------------------------------------------
     */
    /** @link  http://stackoverflow.com/questions/12385500/regex-pattern-for-rgb-rgba-hsl-hsla-color-coding */
    const PATTERN_HEX  = '/^#(?:[0-9a-fA-F]{3}){1,2}$/';
    const PATTERN_RGB  = '/^rgb\(\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*\)$/';
    const PATTERN_RGBA = '/^rgba\(\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*((0.[1-9])|[01])\s*\)$/';
    const PATTERN_HSL  = '/^hsl\(\s*(0|[1-9]\d?|[12]\d\d|3[0-5]\d)\s*,\s*((0|[1-9]\d?|100)%)\s*,\s*((0|[1-9]\d?|100)%)\s*\)$/';
    const PATTERN_HSLA = '/^hsla\(\s*(0|[1-9]\d?|[12]\d\d|3[0-5]\d)\s*,\s*((0|[1-9]\d?|100)%)\s*,\s*((0|[1-9]\d?|100)%)\s*\,\s*((0.[1-9])|[01])\s*\)$/';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if the color is valid HEX Color.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public static function validateHex($value)
    {
        return preg_match_all(self::PATTERN_HEX, $value) !== 0;
    }

    /**
     * Check if the color is valid RGB Color.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public static function validateRgb($value)
    {
        return preg_match_all(self::PATTERN_RGB, $value) !== 0;
    }

    /**
     * Check if the color is valid RGBA Color.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public static function validateRgba($value)
    {
        return preg_match_all(self::PATTERN_RGBA, $value) !== 0;
    }

    /**
     * Check if the color is valid HSL Color.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public static function validateHsl($value)
    {
        return preg_match_all(self::PATTERN_HSL, $value) !== 0;
    }

    /**
     * Check if the color is valid HSLA Color.
     *
     * @param  string  $value
     *
     * @return bool
     */
    public static function validateHsla($value)
    {
        return preg_match_all(self::PATTERN_HSLA, $value) !== 0;
    }
}
