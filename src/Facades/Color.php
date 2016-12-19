<?php namespace Arcanedev\Color\Facades;

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
    protected static function getFacadeAccessor()
    {
        return \Arcanedev\Color\Contracts\Color::class;
    }
}
