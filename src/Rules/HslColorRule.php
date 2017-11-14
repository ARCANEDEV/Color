<?php namespace Arcanedev\Color\Rules;

/**
 * Class     HslColorRule
 *
 * @package  Arcanedev\Color\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HslColorRule extends AbstractColorRule
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var string */
    protected $key     = 'hsl';

    /** @var string */
    protected $pattern = '/^hsl\(\s*(0|[1-9]\d?|[12]\d\d|3[0-5]\d)\s*,\s*((0|[1-9]\d?|100)%)\s*,\s*((0|[1-9]\d?|100)%)\s*\)$/';
}
