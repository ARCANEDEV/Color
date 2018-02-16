<?php namespace Arcanedev\Color\Tests\Rules;

use Arcanedev\Color\Rules\RgbColorRule;

/**
 * Class     RgbColorRuleTest
 *
 * @package  Arcanedev\Color\Tests\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RgbColorRuleTest extends AbstractColorRuleTest
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_pass_valid_colors()
    {
        $validator = $this->getValidatorFactory();

        foreach ($this->getValidColors() as $color) {
            $v = $validator->make(compact('color'), ['color' => ['required', new RgbColorRule]]);

            static::assertTrue($v->passes(), "Failed on {$color}");
            static::assertFalse($v->fails(), "Failed on {$color}");
        }
    }

    /** @test */
    public function it_must_fails_on_invalid_colors_with_messages()
    {
        $validator = $this->getValidatorFactory();

        foreach ($this->getInvalidColors() as $color) {
            $v = $validator->make(['color_picker' => $color], ['color_picker' => ['required', new RgbColorRule]]);

            static::assertFalse($v->passes(), "Failed on {$color}");
            static::assertTrue($v->fails(), "Failed on {$color}");
            static::assertSame(
                'The color picker field has invalid RGB color.',
                $v->messages()->first('color_picker'),
                "Failed on {$color}"
            );
        }
    }

    /** @test */
    public function it_must_fails_on_invalid_colors_with_translated_messages()
    {
        $this->app->setLocale('fr');
        $validator = $this->getValidatorFactory();

        foreach ($this->getInvalidColors() as $color) {
            $v = $validator->make(['color_picker' => $color], ['color_picker' => ['required', new RgbColorRule]]);

            static::assertFalse($v->passes(), "Failed on {$color}");
            static::assertTrue($v->fails(), "Failed on {$color}");
            static::assertSame(
                'Le champ color picker a une couleur RGB invalide.',
                $v->messages()->first('color_picker'),
                "Failed on {$color}"
            );
        }
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the valid colors.
     *
     * @return array
     */
    private function getValidColors()
    {
        return [
            'rgb(0,0,0)', 'rgb(0, 0, 0)', 'rgb( 0, 0, 0)', 'rgb( 0 , 0 , 0 )', 'rgb(0 , 0 , 0)',
            'rgb(  0  ,  0  ,  0  )', 'rgb(255,255,255)', 'rgb(255, 255, 255)', 'rgb( 255, 255, 255)',
            'rgb( 255 , 255 , 255 )', 'rgb(255 , 255 , 255)', 'rgb(  255  ,  255  ,  255  )',
        ];
    }

    /**
     * Get the invalid colors.
     *
     * @return array
     */
    private function getInvalidColors()
    {
        return [
            'rgb(256,0,0)', 'rgb(0,256,0)', 'rgb(0,0,256)', 'rgb(256, 0, 0)', 'rgb(0, 256, 0)', 'rgb(0, 0, 256)',
            'rgb( 256 , 0 , 0 )', 'rgb( 0 , 256 , 0 )', 'rgb( 0 , 0 , 256 )', 'rgb(256,256,0)', 'rgb(256,0,256)',
            'rgb(0,256,256)', 'rgb(256, 256, 0)', 'rgb(256, 0, 256)', 'rgb(0, 256, 256)', 'rgb( 256 , 256 , 0 )',
            'rgb( 256 , 0 , 256 )', 'rgb( 0 , 256 , 256 )',
        ];
    }
}
