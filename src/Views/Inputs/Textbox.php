<?php
namespace UiBuilder\Form\Views\Inputs;

use Illuminate\View\Component;

class Textbox extends Component
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function render()
    {
        return view('form::inputs.textbox');
    }
}