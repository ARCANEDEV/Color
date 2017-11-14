<?php namespace Arcanedev\Color;

use Arcanedev\Support\PackageServiceProvider;

/**
 * Class     ColorServiceProvider
 *
 * @package  Arcanedev\Color
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ColorServiceProvider extends PackageServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'color';

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

        $this->loadTranslations();
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
}
