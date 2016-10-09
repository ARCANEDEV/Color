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
    public static function isValidHex($hex)
    {
        return preg_match_all('/^#(?:[0-9a-fA-F]{3}){1,2}$/', $hex) !== 0;
    }
}
