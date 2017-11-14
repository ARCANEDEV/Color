<?php namespace Arcanedev\Color\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class     AbstractColorRule
 *
 * @package  Arcanedev\Color\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractColorRule implements Rule
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var string */
    protected $key     = '';

    /**
     * @var string
     *
     * @link  http://stackoverflow.com/questions/12385500/regex-pattern-for-rgb-rgba-hsl-hsla-color-coding
     */
    protected $pattern = '';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->matchAll($this->pattern, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans("color::validation.{$this->key}.invalid");
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if match all.
     *
     * @param  string  $pattern
     * @param  string  $value
     *
     * @return bool
     */
    protected function matchAll($pattern, $value)
    {
        return preg_match_all($pattern, $value) !== 0;
    }
}
