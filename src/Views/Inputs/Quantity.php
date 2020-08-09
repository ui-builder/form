<?php
namespace UiBuilder\Form\Views\Inputs;

use Illuminate\View\Component;

class Quantity extends Input
{
    public function __construct(string $name, string $type = "number")
    {
        parent::__construct($name, $type);
        $this->attributes->merge([
            'min' => 0
        ]);
    }
}