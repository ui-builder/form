<?php
namespace UiBuilder\Form\Views;

use Illuminate\View\Component;

class Error extends Component
{
    public string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }
    public function render()
    {
        return view('form::error');
    }
}