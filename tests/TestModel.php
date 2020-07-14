<?php
namespace UiBuilder\Form\Tests;

use GetThingsDone\Attributes\Concerns\InteractsWithCastAttributes;
use GetThingsDone\Attributes\Contracts\HasCastAttributes;
use UiBuilder\Form\Contracts\HasForm;
use Illuminate\Database\Eloquent\Model;
use GetThingsDone\Types\Contracts\HasTypes;
use UiBuilder\Form\Concerns\InteractsWithForm;
use GetThingsDone\Types\Concerns\InteractsWithTypes;

class TestModel extends Model implements HasCastAttributes
{
    use InteractsWithCastAttributes;
    
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