<?php namespace Arcanedev\Color\Tests\Rules;

use Arcanedev\Color\Rules\HslColorRule;

/**
 * Class     HslColorRuleTest
 *
 * @package  Arcanedev\Color\Tests\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HslColorRuleTest extends AbstractColorRuleTest
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
            $v = $validator->make(compact('color'), ['color' => ['required', new HslColorRule]]);

            static::assertTrue($v->passes(), "Failed on {$color}");
            static::assertFalse($v->fails(), "Failed on {$color}");
        }
    }

    /** @test */
    public function it_must_fails_on_invalid_colors_with_messages()
    {
        $validator = $this->getValidatorFactory();

        foreach ($this->getInvalidColors() as $color) {
            $v = $validator->make(['color_picker' => $color], ['color_picker' => ['required', new HslColorRule]]);

            static::assertFalse($v->passes(), "Failed on {$color}");
            static::assertTrue($v->fails(), "Failed on {$color}");
            static::assertSame(
                'The color picker field has invalid HSL color.',
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
            $v = $validator->make(['color_picker' => $color], ['color_picker' => ['required', new HslColorRule]]);

            static::assertFalse($v->passes(), "Failed on {$color}");
            static::assertTrue($v->fails(), "Failed on {$color}");
            static::assertSame(
                'Le champ color picker a une couleur HSL invalide.',
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
            'hsl(0, 0%, 0%)', 'hsl(359, 0%, 0%)', 'hsl(0, 100%, 0%)', 'hsl(359, 100%, 0%)', 'hsl(0, 0%, 100%)',
            'hsl(359, 0%, 100%)', 'hsl(0, 100%, 100%)', 'hsl(359, 100%, 100%)', 'hsl(0, 100%, 100%)',
            'hsl(120, 100%, 100%)', 'hsl(240, 100%, 100%)',
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
            'hsl(360, 0%, 0%)', 'hsl(0, 200%, 0%)', 'hsl(0, 0, 0)', 'hsl(0, 0%, 200%)', 'hsl(0, 0%, 100)',
            'hsl(359, 0, 100%)', 'hsl(0, 200%, 200%)',
        ];
    }
}
