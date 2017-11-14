<?php namespace Arcanedev\Color\Tests\Rules;

use Arcanedev\Color\Rules\RgbaColorRule;

/**
 * Class     RgbaColorRuleTest
 *
 * @package  Arcanedev\Color\Tests\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RgbaColorRuleTest extends AbstractColorRuleTest
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
            $v = $validator->make(compact('color'), ['color' => ['required', new RgbaColorRule]]);

            $this->assertTrue($v->passes(), "Failed on {$color}");
            $this->assertFalse($v->fails(), "Failed on {$color}");
        }
    }

    /** @test */
    public function it_must_fails_on_invalid_colors_with_messages()
    {
        $validator = $this->getValidatorFactory();

        foreach ($this->getInvalidColors() as $color) {
            $v = $validator->make(['color_picker' => $color], ['color_picker' => ['required', new RgbaColorRule]]);

            $this->assertFalse($v->passes(), "Failed on {$color}");
            $this->assertTrue($v->fails(), "Failed on {$color}");
            $this->assertSame(
                'The color picker field has invalid RGBA color.',
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
            $v = $validator->make(['color_picker' => $color], ['color_picker' => ['required', new RgbaColorRule]]);

            $this->assertFalse($v->passes(), "Failed on {$color}");
            $this->assertTrue($v->fails(), "Failed on {$color}");
            $this->assertSame(
                'Le champ color picker a une couleur RGBA invalide.',
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
            'rgba(0,0,0,0)', 'rgba(0, 0, 0, 0)', 'rgba( 0, 0, 0, 0)', 'rgba( 0 , 0 , 0, 0 )', 'rgba(0 , 0 , 0, 1)',
            'rgba(  0  ,  0  ,  0  ,  1  )', 'rgba(0,0,0,0.1)', 'rgba(255,255,255,1)', 'rgba(255, 255, 255, 0)',
            'rgba( 255, 255, 255, 1)', 'rgba( 255 , 255 , 255 , 0 )', 'rgba(255 , 255 , 255, 0)',
            'rgba(  255  ,  255  ,  255  ,  1  )', 'rgba(255,255,255,0.2)',
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
            'rgba(256,0,0,1)', 'rgba(0,256,0,0)', 'rgba(0,0,256,1)', 'rgba(256, 0, 0, 0)', 'rgba(0, 256, 0, 1)',
            'rgba(0, 0, 256, 0)', 'rgba( 256 , 0 , 0 , 1)', 'rgba( 0 , 256 , 0 , 0)', 'rgba( 0 , 0 , 256 , 1)',
            'rgba(256,256,0,0)', 'rgba(256,0,256,1)', 'rgba(0,256,256,0)', 'rgba(256, 256, 0, 0.1)',
            'rgba(256, 0, 256, 0.2)', 'rgba(0, 256, 256, 0.3)', 'rgba( 256 , 256 , 0 , 0.4)',
            'rgba( 256 , 0 , 256 , 0.5)', 'rgba( 0 , 256 , 256 , 0.6)',
        ];
    }
}
