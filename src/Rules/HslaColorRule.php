<?php namespace Arcanedev\Color\Rules;

/**
 * Class     HslColorRule
 *
 * @package  Arcanedev\Color\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HslaColorRule extends AbstractColorRule
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var string */
    protected $key     = 'hsla';

    /** @var string */
    protected $pattern = '/^hsla\(\s*(0|[1-9]\d?|[12]\d\d|3[0-5]\d)\s*,\s*((0|[1-9]\d?|100)%)\s*,\s*((0|[1-9]\d?|100)%)\s*\,\s*((0.[1-9])|[01])\s*\)$/';
}
