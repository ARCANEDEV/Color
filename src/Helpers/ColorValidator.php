<?php namespace Arcanedev\Color\Helpers;

/**
 * Class     ColorValidator
 *
 * @package  Arcanedev\Color\Helpers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorValidator
{
    /**
     * Check if the color is valid HEX Color.
     *
     * @param  string  $hex
     *
     * @return bool
     */
    public static function isValidHex($hex)
    {
        return preg_match_all('/^#(?:[0-9a-fA-F]{3}){1,2}$/', $hex) !== 0;
    }
}
