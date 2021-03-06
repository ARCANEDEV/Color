<?php namespace Arcanedev\Color;

use Arcanedev\Color\Contracts\Color as ColorContract;
use Arcanedev\Color\Exceptions\ColorException;

/**
 * Class     Color
 *
 * @package  Arcanedev\Color
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Color implements ColorContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Red value.
     *
     * @var int
     */
    protected $red = 0;

    /**
     * Green value.
     *
     * @var int
     */
    protected $green = 0;

    /**
     * Blue value.
     *
     * @var int
     */
    protected $blue = 0;

    /**
     * Alpha value.
     *
     * @var float
     */
    protected $alpha = 1.0;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Color constructor.
     *
     * @param  int        $red
     * @param  int        $green
     * @param  int        $blue
     * @param  float|int  $alpha
     */
    public function __construct($red = 0, $green = 0, $blue = 0, $alpha = 1.0)
    {
        $this->setRgba($red, $green, $blue, $alpha);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

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
    public function setRgba($red, $green, $blue, $alpha)
    {
        return $this->setRgb($red, $green, $blue)
            ->setAlpha($alpha);
    }

    /**
     * Set the RGB values.
     *
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return self
     */
    public function setRgb($red, $green, $blue)
    {
        return $this->setRed($red)->setGreen($green)->setBlue($blue);
    }

    /**
     * Get red value.
     *
     * @return int
     */
    public function red()
    {
        return $this->red;
    }

    /**
     * Set the red value.
     *
     * @param  int  $red
     *
     * @return self
     */
    public function setRed($red)
    {
        $this->checkColorValue('red', $red);
        $this->red = $red;

        return $this;
    }

    /**
     * Get the green value.
     *
     * @return int
     */
    public function green()
    {
        return $this->green;
    }

    /**
     * Set the green value.
     *
     * @param  int  $green
     *
     * @return self
     */
    public function setGreen($green)
    {
        $this->checkColorValue('green', $green);
        $this->green = $green;

        return $this;
    }

    /**
     * Get the blue value.
     *
     * @return int
     */
    public function blue()
    {
        return $this->blue;
    }

    /**
     * Set the blue value.
     *
     * @param  int  $blue
     *
     * @return self
     */
    public function setBlue($blue)
    {
        $this->checkColorValue('blue', $blue);
        $this->blue = $blue;

        return $this;
    }

    /**
     * Get the alpha value.
     *
     * @return float
     */
    public function alpha()
    {
        return $this->alpha;
    }

    /**
     * Set the alpha value.
     *
     * @param  float|int  $alpha
     *
     * @return self
     */
    public function setAlpha($alpha)
    {
        $this->checkAlphaValue($alpha);
        $this->alpha = $alpha;

        return $this;
    }

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
    public static function make($color)
    {
        self::checkHex($color);

        list($red, $green, $blue) = ColorConverter::hexToRgb($color);

        return new self($red, $green, $blue);
    }

    /**
     * Convert to hex color.
     *
     * @param  bool  $uppercase
     *
     * @return string
     */
    public function toHex($uppercase = true)
    {
        $hex = ColorConverter::rgbToHex($this->red, $this->green, $this->blue);

        return $uppercase ? strtoupper($hex) : strtolower($hex);
    }

    /**
     * Parse the object to string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toHex();
    }

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
    public function isBright($contrast = 150)
    {
        return $contrast < sqrt(
            (pow($this->red, 2)   * .299) +
            (pow($this->green, 2) * .587) +
            (pow($this->blue, 2)  * .114)
        );
    }

    /**
     * Check if the color is dark.
     *
     * @param  float|int  $contrast
     *
     * @return bool
     */
    public function isDark($contrast = 150)
    {
        return ! $this->isBright($contrast);
    }

    /**
     * Check if the color is valid.
     *
     * @param  string  $hex
     *
     * @return bool
     */
    public static function isValidHex($hex)
    {
        return ColorValidator::validateHex($hex);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the color.
     *
     * @param  string  $value
     *
     * @throws \Arcanedev\Color\Exceptions\ColorException
     */
    private static function checkHex($value)
    {
        if ( ! self::isValidHex($value))
            throw new ColorException("Invalid HEX Color [$value].");
    }

    /**
     * Set color value.
     *
     * @param  string  $name
     * @param  int     $value
     *
     * @throws \Arcanedev\Color\Exceptions\ColorException
     */
    private function checkColorValue($name, $value)
    {
        if ( ! is_int($value))
            throw new ColorException("The $name value must be an integer.");

        if ($value < 0 || $value > 255)
            throw new ColorException(
                "The $name value must be between 0 and 255, [$value] is given."
            );
    }

    /**
     * Check the alpha value.
     *
     * @param  float|int  $alpha
     *
     * @throws \Arcanedev\Color\Exceptions\ColorException
     */
    public function checkAlphaValue(&$alpha)
    {
        if ( ! is_numeric($alpha))
            throw new ColorException("The alpha value must be a float or an integer.");

        $alpha = (float) $alpha;

        if ($alpha < 0 || $alpha > 1)
            throw new ColorException(
                "The alpha value must be between 0 and 1, [$alpha] is given."
            );
    }
}
