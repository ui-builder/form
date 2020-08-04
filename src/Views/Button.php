<?php
namespace UiBuilder\Form\Views;

use Illuminate\View\Component;

class Button extends Component
{
    public string $type = 'button';

    public string $text;

    public function __construct(string $type = 'button',string $text)
    {
        $this->type = $type;
        $this->text = $text;
    }

    public function render()
    {
        return view('form::button');
    }
}