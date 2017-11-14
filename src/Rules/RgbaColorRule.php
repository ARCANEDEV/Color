<?php namespace Arcanedev\Color\Rules;

/**
 * Class     RgbaColorRule
 *
 * @package  Arcanedev\Color\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RgbaColorRule extends AbstractColorRule
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var string */
    protected $key = 'rgba';

    protected $pattern = '/^rgba\(\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*(0|[1-9]\d?|1\d\d?|2[0-4]\d|25[0-5])\s*,\s*((0.[1-9])|[01])\s*\)$/';
}
