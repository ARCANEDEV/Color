<?php namespace Arcanedev\Color\Tests\Rules;

use Arcanedev\Color\Rules\HexColorRule;

/**
 * Class     HexColorRuleTest
 *
 * @package  Arcanedev\Color\Tests\Rules
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HexColorRuleTest extends AbstractColorRuleTest
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
            $v = $validator->make(compact('color'), ['color' => ['required', new HexColorRule]]);

            $this->assertTrue($v->passes(), "Failed on {$color}");
            $this->assertFalse($v->fails(), "Failed on {$color}");
        }
    }

    /** @test */
    public function it_must_fails_on_invalid_colors_with_messages()
    {
        $validator = $this->getValidatorFactory();

        foreach ($this->getInvalidColors() as $color) {
            $v = $validator->make(['color_picker' => $color], ['color_picker' => ['required', new HexColorRule]]);

            $this->assertFalse($v->passes(), "Failed on {$color}");
            $this->assertTrue($v->fails(), "Failed on {$color}");
            $this->assertSame(
                'The color picker field has invalid HEX color.',
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
            $v = $validator->make(['color_picker' => $color], ['color_picker' => ['required', new HexColorRule]]);

            $this->assertFalse($v->passes(), "Failed on {$color}");
            $this->assertTrue($v->fails(), "Failed on {$color}");
            $this->assertSame(
                'Le champ color picker a une couleur HEX invalide.',
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
     * Get the valid color.
     *
     * @return array
     */
    private function getValidColors()
    {
        return [
            '#000', '#000000', '#fff', '#FFF', '#ffffff', '#FFFFFF',
            '#ff0000', '#f00', '#00ff00', '#0f0', '#0000ff', '#00f',
            '#FF0000', '#F00', '#00FF00', '#0F0', '#0000FF', '#00F',
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
            '#0000', '#00000', '#ffff', '#FFFF', '#fffff', '#FFFFF', '#hello', '#hashtag',
            '#ff000', '#f00l', '#0ff0', '#y0l0', '#000ff', '#00ff', '#KKK', '#kkk'
        ];
    }
}
