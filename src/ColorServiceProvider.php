<?php namespace Arcanedev\Color;

use Illuminate\Support\ServiceProvider;

/**
 * Class     ColorServiceProvider
 *
 * @package  Arcanedev\Color
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('arcanedev.color', Color::class);
        $this->app->bind(Contracts\Color::class, 'arcanedev.color');

        $this->app->bind('arcanedev.color.converter', ColorConverter::class);
        $this->app->bind(Contracts\ColorConverter::class, 'arcanedev.color.converter');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanedev.color',
            'arcanedev.color.converter',
            Contracts\Color::class,
            Contracts\ColorConverter::class,
        ];
    }
}
