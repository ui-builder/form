<?php

namespace UiBuilder\Form\Tests;

use Orchestra\Testbench\TestCase;
use UiBuilder\Form\FormServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [FormServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
