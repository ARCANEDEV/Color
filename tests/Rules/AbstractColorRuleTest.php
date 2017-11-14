<?php namespace Arcanedev\Color\Tests\Rules;

use Arcanedev\Color\Tests\LaravelTestCase;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

/**
 * Class     AbstractColorRuleTest
 *
 * @package  Arcanedev\Color\Tests\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractColorRuleTest extends LaravelTestCase
{
    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Make a validator.
     *
     * @return \Illuminate\Validation\Factory $validator
     */
    protected function getValidatorFactory()
    {
        return $this->app->make(ValidationFactory::class);
    }
}
