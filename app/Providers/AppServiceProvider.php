<?php

namespace App\Providers;

use App\Settings\GeneralSettings;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en']); // also accepts a closure
        });

        $setting = app(GeneralSettings::class);


        $ViewWithSettings = function ($view) use ($setting) {
            $view->with('setting', $setting);
        };


        view()->composer('site.*', $ViewWithSettings);
        view()->composer('components.*', $ViewWithSettings);
    }
}
