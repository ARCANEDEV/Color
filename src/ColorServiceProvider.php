<?php namespace Arcanedev\Color;

use Arcanedev\Support\ServiceProvider;

/**
 * Class     ColorServiceProvider
 *
 * @package  Arcanedev\Color
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application services.
     */
    public function register()
    {
        parent::register();

        $this->bind(Contracts\Color::class, Color::class);
        $this->bind(Contracts\ColorConverter::class, ColorConverter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        parent::boot();

        $this->extendValidator();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Contracts\Color::class,
            Contracts\ColorConverter::class,
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Extend validator.
     */
    private function extendValidator()
    {
        /** @var \Illuminate\Validation\Factory $validator */
        $validator = $this->app->make('validator');

        $validator->extend('color',   'Arcanedev\\Color\\Laravel\\ColorValidator@validate');
        $validator->replacer('color', 'Arcanedev\\Color\\Laravel\\ColorValidator@message');
    }
}
