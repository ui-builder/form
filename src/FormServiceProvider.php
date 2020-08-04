<?php

namespace UiBuilder\Form;

use Livewire\Livewire;
use Illuminate\Support\Str;
use UiBuilder\Form\Views\Form;
use UiBuilder\Form\Views\Error;
use UiBuilder\Form\Views\Label;
use UiBuilder\Form\Views\Button;
use UiBuilder\Form\Views\Fieldsets;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use UiBuilder\Form\Views\Inputs\{Input,Textbox,Textarea,Email, Image};

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
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'form');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'form');
        $this->loadViewComponentsAs('',[
            'form.label' => Label::class,
            'form.error'=> Error::class,
            'form.button' => Button::class,
            'form.fieldsets' => Fieldsets::class,
            'form.inputs.input' => Input::class,
            'form.inputs.textbox' => Textbox::class,
            'form.inputs.email'=>Email::class,
            'form.inputs.textarea' => Textarea::class,
            'form.inputs.image' => Image::class,
        ]);
        Livewire::component('form',Form::class);
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/form'),
            ], 'lang');

            // Registering package commands.
            // $this->commands([]);
        }


        Blade::directive('render', function ($expression) {

            if( Str::contains($expression, ',') )
            {
                [$componentClassname, $attributes] = explode(',',$expression);
            }else{
                $componentClassname = $expression;
                $attributes = '[]';
            }
            
            return "<?php \$component = app($componentClassname, $attributes); \$view = \$component->resolveView(); \$data = \$component->data(); \$data['attributes'] = new \Illuminate\View\ComponentAttributeBag({$attributes}['input'] ?? []); \$view->with(\$data); ?> {{ \$view }}";
        });
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
            return new \UiBuilder\Form\Form;
        });
    }
}
