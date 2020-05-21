<?php
namespace UiBuilder\Form\View;

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
        return view('form::textbox');
    }
}