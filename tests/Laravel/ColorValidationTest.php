<?php namespace Arcanedev\Color\Tests\Laravel;

use Arcanedev\Color\Tests\LaravelTestCase;

/**
 * Class     ColorValidationTest
 *
 * @package  Arcanedev\Color\Tests\Laravel
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorValidationTest extends LaravelTestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_pass_hex_color_validation()
    {
        $rules  = ['color' => 'required|color:hex'];
        $colors = [
            '#FFFFFF', '#FFF', '#ffffff', '#fff',
            '#000000', '#000', '#BADA55', '#bada55'
        ];

        foreach ($colors as $color) {
            $validator = $this->validator()->make(compact('color'), $rules);
            $this->assertTrue($validator->passes());
            $this->assertFalse($validator->fails());
        }
    }

    /** @test */
    public function it_can_must_fails_hex_color_validation()
    {
        $rules  = ['color' => 'required|color:hex'];
        $colors = [
            '#FF', '#FFFF', '#ff', '#ffff', '#00000', '#00', '#KKK'
        ];

        foreach ($colors as $color) {
            $validator = $this->validator()->make(compact('color'), $rules);
            $this->assertTrue($validator->fails());
            $this->assertFalse($validator->passes());
            $this->assertSame(
                $validator->messages()->first('color'),
                'The color field is not a valid hex color.'
            );
        }
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\Color\Exceptions\ColorException
     * @expectedExceptionMessage  You must specify the color type in your validation rule.
     */
    public function it_must_throw_an_exception_if_type_is_not_specified_in_color_rule()
    {
        $validator = $this->validator()->make([
            'color' => '#B000B5'
        ],[
            'color' => 'required|color'
        ]);

        $validator->passes();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the validator instance.
     *
     * @return \Illuminate\Validation\Factory
     */
    protected function validator()
    {
        return $this->app->make('validator');
    }
}
