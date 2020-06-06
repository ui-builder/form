<?php
namespace UiBuilder\Form\Tests;

use UiBuilder\Form\Contracts\HasForm;
use Illuminate\Database\Eloquent\Model;
use GetThingsDone\Types\Contracts\HasTypes;
use UiBuilder\Form\Concerns\InteractsWithForm;
use GetThingsDone\Types\Concerns\InteractsWithTypes;

class TestModel implements HasForm, HasTypes
{
    use InteractsWithForm,
        InteractsWithTypes;
    
    public function getFillable()
    {
        return [
            'title'
        ];
    }

    public function getCasts()
    {
        return [];
    }

    public function getRules()
    {
        return [
            'name' => 'required'
        ];
    }
}