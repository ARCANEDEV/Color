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
    public static function isValidHex($hex);
}
