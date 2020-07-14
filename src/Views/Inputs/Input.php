<?php
namespace UiBuilder\Form\Views\Inputs;

use Illuminate\View\Component;

class Input extends Component
{
    public string $name;

    public string $type;

    public function __construct(string $name,string $type)
    {
        $this->name = $name;
        $this->type = $type;
    }
    public function render()
    {
        return view('form::inputs.input');
    }
}