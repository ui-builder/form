<?php
namespace UiBuilder\Form\Tests;

use Livewire\Livewire;
use UiBuilder\Form\View\Form;

class FormValidateTest extends TestCase
{
    /**
     * @test
     */
    public function has_rules_from_model()
    {
        $component = Livewire::test(Form::class,[
            'model' => new TestModel
        ])->assertSet('rules',[
            'name' => 'required'
        ]);
    }
    /**
     * @test
     */
    public function validate_fail()
    {
        $component = Livewire::test(Form::class,[
            'model' => new TestModel
        ])->call('save')
        ->assertHasErrors([
            'fieldsets.name' => 'required'
        ]);
    }
}