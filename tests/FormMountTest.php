<?php
namespace UiBuilder\Form\Tests;

use Livewire\Livewire;
use UiBuilder\Form\View\Form;

class FormMountTest extends TestCase
{
    /**
     * @test
     */
    public function component_contains_fieldsets()
    {
        $component = Livewire::test(Form::class,[
            'model' => new TestModel
        ])->set('fieldsets.title','test')
        ->assertSet('fieldsets.title','test');
    }
}