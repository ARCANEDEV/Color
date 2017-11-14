<?php namespace Arcanedev\Color\Rules;

/**
 * Class     HexColorRule
 *
 * @package  Arcanedev\Color\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HexColorRule extends AbstractColorRule
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var string */
    protected $key     = 'hex';

    /** @var string */
    protected $pattern = '/^#(?:[0-9a-fA-F]{3}){1,2}$/';
}
