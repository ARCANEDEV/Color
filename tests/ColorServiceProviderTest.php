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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var \Arcanedev\Color\ColorServiceProvider */
    protected $provider;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(ColorServiceProvider::class);
    }

    protected function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            ColorServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [
            \Arcanedev\Color\Contracts\Color::class,
            \Arcanedev\Color\Contracts\ColorConverter::class,
        ];

        static::assertSame($expected, $this->provider->provides());
    }

    /** @test */
    public function it_can_make_color_instance_with_contract()
    {
        static::assertInstanceOf(
            \Arcanedev\Color\Color::class,
            $this->app->make(\Arcanedev\Color\Contracts\Color::class)
        );
    }

    /** @test */
    public function it_can_make_color_converter_instance_with_contract()
    {
        static::assertInstanceOf(
            \Arcanedev\Color\ColorConverter::class,
            $this->app->make(\Arcanedev\Color\Contracts\ColorConverter::class)
        );
    }
}
