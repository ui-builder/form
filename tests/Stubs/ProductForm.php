<?php
namespace UiBuilder\Form\Tests\Stubs;

use UiBuilder\Form\Views\Form;
use UiBuilder\Form\Contracts\HasResource;
use UiBuilder\Form\Concerns\InteractsWithResource;

class ProductForm extends Form implements HasResource
{
    use InteractsWithResource;

    public function onSaving()
    {
        $this->validateForm();
    }
}