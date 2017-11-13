<?php namespace Arcanedev\Color\Facades;

use Arcanedev\Color\Contracts\Color as ColorContract;
use Illuminate\Support\Facades\Facade;

/**
 * Class     Color
 *
 * @package  Arcanedev\Color\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Color extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return ColorContract::class; }
}
