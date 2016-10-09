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
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
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

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Color constructor.
     *
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     */
    public function __construct($red = 0, $green = 0, $blue = 0)
    {
        $this->setRGB($red, $green, $blue);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
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
    public function setRGB($red, $green, $blue)
    {
        return $this->setRed($red)
                    ->setGreen($green)
                    ->setBlue($blue);
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
        $this->checkValue($red);
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
        $this->checkValue($green);
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
        $this->checkValue($blue);
        $this->blue = $blue;

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make a Color instance.
     *
     * @param  string  $value
     *
     * @return self
     */
    public static function make($value)
    {
        self::checkHex($value);

        list($red, $green, $blue) = self::extractRGB($value);

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
        $hex = implode('', array_map(function ($value) {
            return str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
        }, [$this->red, $this->green, $this->blue]));

        return '#' . ($uppercase ? strtoupper($hex) : strtolower($hex));
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

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if the color is bright.
     *
     * @return bool
     */
    public function isBright()
    {
        return ($this->red + $this->green + $this->blue) > 382;
    }

    /**
     * Check if the color is dark.
     *
     * @return bool
     */
    public function isDark()
    {
        return ! $this->isBright();
    }

    /**
     * Check if the color is valid.
     *
     * @param  string  $hex
     *
     * @return bool
     */
    public static function isValid($hex)
    {
        return preg_match_all('/^#(?:[0-9a-fA-F]{3}){1,2}$/', $hex) !== 0;
    }

    /**
     * Check the color.
     *
     * @param  string  $value
     *
     * @throws \Arcanedev\Color\Exceptions\ColorException
     */
    private static function checkHex($value)
    {
        if ( ! self::isValid($value))
            throw new ColorException("Invalid HEX Color [$value].");
    }

    /**
     * Set color value.
     *
     * @param  int  $value
     *
     * @throws \Arcanedev\Color\Exceptions\ColorException
     */
    private function checkValue($value)
    {
        if ( ! is_int($value))
            throw new ColorException('The color value must be an integer.');

        if ($value < 0 || $value > 255)
            throw new ColorException(
                "The color value must be between 0 and 255, [$value] is given."
            );
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Extract RGB value.
     *
     * @param  string  $value
     *
     * @return array
     */
    protected static function extractRGB($value)
    {
        $value = str_replace('#', '', $value);

        return array_map('hexdec', strlen($value) === 6 ? [
            substr($value, 0, 2),
            substr($value, 2, 2),
            substr($value, 4, 2),
        ] : [
            str_repeat(substr($value, 0, 1), 2),
            str_repeat(substr($value, 1, 1), 2),
            str_repeat(substr($value, 2, 1), 2),
        ]);
    }
}