<?php

namespace UiBuilder\Form\Tests;

use GetThingsDone\Attributes\AttributesServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use UiBuilder\Form\FormServiceProvider;

class TestCase extends BaseTestCase
{

    protected function getPackageProviders($app)
    {
        return [
            FormServiceProvider::class,
            LivewireServiceProvider::class,
            AttributesServiceProvider::class,
        ];
    }
}
