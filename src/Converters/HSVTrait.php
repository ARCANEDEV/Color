<?php namespace Arcanedev\Color\Converters;

/**
 * Trait     HSVTrait
 *
 * @package  Arcanedev\Color\Converters
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HSVTrait
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Convert an RGB color to an HSV array (alias).
     *
     * @see    fromRgbToHsv
     *
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return array
     */
    public static function rgbToHsv($red, $green, $blue)
    {
        return (new static)->fromRgbToHsv($red, $green, $blue);
    }

    /**
     * Convert an RGB color to an HSV array.
     *
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return array
     */
    public function fromRgbToHsv($red, $green, $blue)
    {
        $red        = $red   / 255;
        $green      = $green / 255;
        $blue       = $blue  / 255;
        $maxRGB     = max($red, $green, $blue);
        $minRGB     = min($red, $green, $blue);

        $hue        = 0;
        $saturation = 0;
        $value      = 100 * $maxRGB;
        $chroma     = $maxRGB - $minRGB;

        if ($chroma != 0) {
            $saturation = 100 * ($chroma / $maxRGB);
            $hue        = $this->recalculateHue($red, $green, $blue, $minRGB, $chroma) * 60;
        }

        return array_map(function ($value) {
            return round($value, 2);
        }, [$hue, $saturation, $value]);
    }

    /**
     * Convert an HSV color to an RGB array (alias).
     *
     * @see    fromHsvToRgb
     *
     * @param  float|int  $hue
     * @param  float|int  $saturation
     * @param  float|int  $value
     *
     * @return array
     */
    public static function hsvToRgb($hue, $saturation, $value)
    {
        return (new static)->fromHsvToRgb($hue, $saturation, $value);
    }

    /**
     * Convert an HSV color to an RGB array.
     *
     * @param  float|int  $hue
     * @param  float|int  $saturation
     * @param  float|int  $value
     *
     * @return array
     */
    public function fromHsvToRgb($hue, $saturation, $value)
    {
        // Lightness: 0.0 - 1.0
        $lightness = $this->sanitizeHsvValue($value, 0, 100) / 100.0;
        // Chroma:    0.0 - 1.0
        $chroma    = $lightness * ($this->sanitizeHsvValue($saturation, 0, 100) / 100.0);

        return array_map(function ($color) use ($lightness, $chroma) {
            return (int) round(($color + ($lightness - $chroma)) * 255);
        }, $this->calculateRgbWithHueAndChroma($hue, $chroma));
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Recalculate the Hue.
     *
     * @param  float|int  $red
     * @param  float|int  $green
     * @param  float|int  $blue
     * @param  float|int  $minRGB
     * @param  float|int  $chroma
     *
     * @return float|int
     */
    protected function recalculateHue($red, $green, $blue, $minRGB, $chroma)
    {
        switch ($minRGB) {
            case $red:
                return 3 - (($green - $blue) / $chroma);

            case $blue:
                return 1 - (($red - $green) / $chroma);

            case $green:
            default:
                return 5 - (($blue - $red) / $chroma);
        }
    }

    /**
     * Calculate RGB with hue and chroma.
     *
     * @param  float|int  $hue
     * @param  float|int  $chroma
     *
     * @return array
     */
    protected function calculateRgbWithHueAndChroma($hue, $chroma)
    {
        $hPrime = $this->sanitizeHsvValue($hue, 0, 360) / 60.0;
        $xPrime = $this->calculateXPrime($hPrime, $chroma);
        $colors = $this->getColorsRange($chroma, $xPrime);
        $index  = (int) floor($hPrime);

        return array_key_exists($index, $colors)
            ? $colors[$index]
            : [0.0, 0.0, 0.0];
    }

    /**
     * Calculate X-Prime.
     *
     * @param  float|int  $hPrime
     * @param  float|int  $chroma
     *
     * @return float|int
     */
    protected function calculateXPrime($hPrime, $chroma)
    {
        while ($hPrime >= 2.0)
            $hPrime -= 2.0;

        return $chroma * (1 - abs($hPrime - 1));
    }

    /**
     * Sanitize HSV value.
     *
     * @param  int  $value
     * @param  int  $min
     * @param  int  $max
     *
     * @return float|int
     */
    protected function sanitizeHsvValue($value, $min, $max)
    {
        if ($value < $min) return $min;
        if ($value > $max) return $max;

        return $value;
    }

    /**
     * Get the colors range.
     *
     * @param  float|int  $chroma
     * @param  float|int  $xPrime
     *
     * @return array
     */
    protected function getColorsRange($chroma, $xPrime)
    {
        return [
            0 => [$chroma, $xPrime, 0.0],
            1 => [$xPrime, $chroma, 0.0],
            2 => [0.0, $chroma, $xPrime],
            3 => [0.0, $xPrime, $chroma],
            4 => [$xPrime, 0.0, $chroma],
            5 => [$chroma, 0.0, $xPrime],
        ];
    }
}
