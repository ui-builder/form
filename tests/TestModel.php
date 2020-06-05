<?php
namespace UiBuilder\Form\Tests;

use UiBuilder\Form\Contracts\HasForm;
use Illuminate\Database\Eloquent\Model;
use UiBuilder\Form\Concerns\InteractsWithForm;

class TestModel implements HasForm
{
    use InteractsWithForm;
    
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

    public function getAttributeNames()
    {
        return [
            'name' => 'Name'
        ];
    }

    public function getRules()
    {
        return [
            'name' => 'required'
        ];
    }
}