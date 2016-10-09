<?php namespace Arcanedev\Color\Helpers\Converters;

/**
 * Class     HSVTrait
 *
 * @package  Arcanedev\Color\Helpers\Converters
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HSVTrait
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Convert an RGB color to an HSV array.
     *
     * @param  int  $red
     * @param  int  $green
     * @param  int  $blue
     *
     * @return array
     */
    public static function rgbToHsv($red, $green, $blue)
    {
        $red   = ($red / 255);
        $green = ($green / 255);
        $blue  = ($blue / 255);

        $maxRGB     = max($red, $green, $blue);
        $minRGB     = min($red, $green, $blue);
        $chroma     = $maxRGB - $minRGB;

        $hue        = 0;
        $saturation = 0;
        $value      = 100 * $maxRGB;

        if ($chroma != 0) {
            $saturation = 100 * ($chroma / $maxRGB);

            if ($red == $minRGB)
                $hue = 3 - (($green - $blue) / $chroma);
            elseif ($blue == $minRGB)
                $hue = 1 - (($red - $green) / $chroma);
            else // $green == $minRGB
                $hue = 5 - (($blue - $red) / $chroma);

            $hue = 60 * $hue;
        }

        return [
            round($hue, 2),
            round($saturation, 2),
            round($value, 2),
        ];
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
    public static function hsvToRgb($hue, $saturation, $value)
    {
        $lightness = self::sanitizeHsvValue($value, 0, 100) / 100.0;                     // Lightness:  0.0-1.0
        $chroma    = $lightness * (self::sanitizeHsvValue($saturation, 0, 100) / 100.0); // Chroma:     0.0-1.0

        return array_map(function ($color) use ($lightness, $chroma) {
            return (int) round(($color + ($lightness - $chroma)) * 255);
        }, self::calculateRgbWithHueAndChroma($hue, $chroma));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Calculate RGB with hue and chroma.
     *
     * @param  float|int  $hue
     * @param  float|int  $chroma
     *
     * @return array
     */
    protected static function calculateRgbWithHueAndChroma($hue, $chroma)
    {
        $hPrime = self::sanitizeHsvValue($hue, 0, 360) / 60.0;
        $xPrime = self::calculateXPrime($hPrime, $chroma);

        switch (floor($hPrime)) {
            case 0: return [$chroma, $xPrime, 0.0];
            case 1: return [$xPrime, $chroma, 0.0];
            case 2: return [0.0, $chroma, $xPrime];
            case 3: return [0.0, $xPrime, $chroma];
            case 4: return [$xPrime, 0.0, $chroma];
            case 5: return [$chroma, 0.0, $xPrime];
        }

        return [0.0, 0.0, 0.0];
    }

    /**
     * Calculate X-Prime.
     *
     * @param  float|int  $hPrime
     * @param  float|int  $chroma
     *
     * @return float|int
     */
    protected static function calculateXPrime($hPrime, $chroma)
    {
        while ($hPrime >= 2.0) $hPrime -= 2.0;

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
    protected static function sanitizeHsvValue($value, $min, $max)
    {
        if ($value < $min) return $min;
        if ($value > $max) return $max;

        return $value;
    }
}
