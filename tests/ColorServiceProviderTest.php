<?php namespace Arcanedev\Color\Tests;

use Arcanedev\Color\ColorServiceProvider;

/**
 * Class     ColorServiceProviderTest
 *
 * @package  Arcanedev\Color\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorServiceProviderTest extends LaravelTestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $provider     = $this->app->getProvider(ColorServiceProvider::class);
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            ColorServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $provider = $this->app->getProvider(ColorServiceProvider::class);
        $expected = [
            'arcanedev.color',
            'arcanedev.color.converter',
            \Arcanedev\Color\Contracts\Color::class,
            \Arcanedev\Color\Contracts\ColorConverter::class,
        ];

        $this->assertSame($expected, $provider->provides());
    }

    /** @test */
    public function it_can_make_color_instance_with_alias()
    {
        $this->assertInstanceOf(
            \Arcanedev\Color\Color::class,
            $this->app->make('arcanedev.color')
        );
    }

    /** @test */
    public function it_can_make_color_instance_with_contract()
    {
        $this->assertInstanceOf(
            \Arcanedev\Color\Color::class,
            $this->app->make(\Arcanedev\Color\Contracts\Color::class)
        );
    }

    /** @test */
    public function it_can_make_color_converter_instance_with_alias()
    {
        $this->assertInstanceOf(
            \Arcanedev\Color\ColorConverter::class,
            $this->app->make('arcanedev.color.converter')
        );
    }

    /** @test */
    public function it_can_make_color_converter_instance_with_contract()
    {
        $this->assertInstanceOf(
            \Arcanedev\Color\ColorConverter::class,
            $this->app->make(\Arcanedev\Color\Contracts\ColorConverter::class)
        );
    }
}
