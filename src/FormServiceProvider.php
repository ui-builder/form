<?php

namespace UiBuilder\Form;

use UiBuilder\Form\View\Email;
use UiBuilder\Form\View\Error;
use UiBuilder\Form\View\Input;
use UiBuilder\Form\View\Label;
use UiBuilder\Form\View\Button;
use UiBuilder\Form\View\Textbox;
use UiBuilder\Form\View\Textarea;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'form');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'form');
        $this->loadViewComponentsAs('',[
            'form.input' => Input::class,
            'form.label' => Label::class,
            'form.error'=> Error::class,
            'form.textbox' => Textbox::class,
            'form.email'=>Email::class,
            'form.textarea' => Textarea::class,
            'form.button' => Button::class,
        ]);
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/4.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('form.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/form'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/form'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/form'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'form');

        // Register the main class to use with the facade
        $this->app->singleton('form', function () {
            return new Form;
        });
    }
}
