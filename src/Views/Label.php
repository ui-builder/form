<?php
namespace UiBuilder\Form\Views;

use Illuminate\View\Component;

class Label extends Component
{
    public string $text;

    public string $for;
    
    public function __construct(string $text,string $for = null)
    {
        $this->text = $text;
        $this->for = $for;
    }
    public function render()
    {
        return view('form::label');
    }
}