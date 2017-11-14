<?php namespace Arcanedev\Color\Tests\Rules;

use Arcanedev\Color\Rules\HslaColorRule;

/**
 * Class     HslaColorRuleTest
 *
 * @package  Arcanedev\Color\Tests\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HslaColorRuleTest extends AbstractColorRuleTest
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
            $v = $validator->make(compact('color'), ['color' => ['required', new HslaColorRule]]);

            $this->assertTrue($v->passes(), "Failed on {$color}");
            $this->assertFalse($v->fails(), "Failed on {$color}");
        }
    }

    /** @test */
    public function it_must_fails_on_invalid_colors_with_messages()
    {
        $validator = $this->getValidatorFactory();

        foreach ($this->getInvalidColors() as $color) {
            $v = $validator->make(['color_picker' => $color], ['color_picker' => ['required', new HslaColorRule]]);

            $this->assertFalse($v->passes(), "Failed on {$color}");
            $this->assertTrue($v->fails(), "Failed on {$color}");
            $this->assertSame(
                'The color picker field has invalid HSLA color.',
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
            $v = $validator->make(['color_picker' => $color], ['color_picker' => ['required', new HslaColorRule]]);

            $this->assertFalse($v->passes(), "Failed on {$color}");
            $this->assertTrue($v->fails(), "Failed on {$color}");
            $this->assertSame(
                'Le champ color picker a une couleur HSLA invalide.',
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
            'hsla(0, 0%, 0%, 0)', 'hsla(359, 0%, 0%, 1)', 'hsla(0, 100%, 0%, 0)', 'hsla(359, 100%, 0%, 1)',
            'hsla(0, 0%, 100%, 0)', 'hsla(359, 0%, 100%, 1)', 'hsla(0, 100%, 100%, 0)', 'hsla(359, 100%, 100%, 1)',
            'hsla(0, 100%, 100%, 1)', 'hsla(120, 100%, 100%, 1)', 'hsla(240, 100%, 100%, 1)',
            'hsla(0, 100%, 100%, 0.1)', 'hsla(120, 100%, 100%, 0.2)', 'hsla(240, 100%, 100%, 0.3)',
            'hsla(0, 100%, 100%, 0.4)', 'hsla(120, 100%, 100%, 0.5)', 'hsla(240, 100%, 100%, 0.6)',
            'hsla(0, 100%, 100%, 0.7)', 'hsla(120, 100%, 100%, 0.8)', 'hsla(240, 100%, 100%, 0.9)',
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
            'hsla(360, 0%, 0%, 1)', 'hsla(0, 200%, 0%, 0)', 'hsla(0, 0, 0, 1)', 'hsla(0, 0%, 200%, 0)',
            'hsla(0, 0%, 100, 1)', 'hsla(359, 0, 100%, 0)', 'hsla(0, 200%, 200%, 1)',
        ];
    }
}
