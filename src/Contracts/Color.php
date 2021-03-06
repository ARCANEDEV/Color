<?php namespace Arcanedev\Color\Contracts;

/**
 * Interface  Color
 *
 * @package   Arcanedev\Color\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Color
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the RGB values.
     *
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return self
     */
    public function setRgb($red, $green, $blue);

    /**
     * Set the RGBA values.
     *
     * @param  int        $red
     * @param  int        $green
     * @param  int        $blue
     * @param  float|int  $alpha
     *
     * @return self
     */
    public function setRgba($red, $green, $blue, $alpha);

    /**
     * Get red value.
     *
     * @return int
     */
    public function red();

    /**
     * Set the red value.
     *
     * @param  int  $red
     *
     * @return self
     */
    public function setRed($red);

    /**
     * Get the green value.
     *
     * @return int
     */
    public function green();

    /**
     * Set the green value.
     *
     * @param  int  $green
     *
     * @return self
     */
    public function setGreen($green);

    /**
     * Get the blue value.
     *
     * @return int
     */
    public function blue();

    /**
     * Set the blue value.
     *
     * @param  int  $blue
     *
     * @return self
     */
    public function setBlue($blue);

    /**
     * Get the alpha value.
     *
     * @return float|int
     */
    public function alpha();

    /**
     * Set the alpha value.
     *
     * @param  float|int  $alpha
     *
     * @return self
     */
    public function setAlpha($alpha);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a Color instance.
     *
     * @param  string  $color
     *
     * @return self
     */
    public static function make($color);

    /**
     * Convert to hex color.
     *
     * @param  bool  $uppercase
     *
     * @return string
     */
    public function toHex($uppercase = true);

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the color is bright.
     *
     * @param  float|int  $contrast
     *
     * @return bool
     */
    public function isBright($contrast = 150);

    /**
     * Check if the color is dark.
     *
     * @param  float|int  $contrast
     *
     * @return bool
     */
    public function isDark($contrast = 150);

    /**
     * Check if the color is valid.
     *
     * @param  string  $hex
     *
     * @return bool
     */
    public static function isValidHex($hex);
}
