<?php
namespace UiBuilder\Form\Views;

use Illuminate\View\Component;
use Illuminate\Support\Collection;

class Fieldsets extends Component
{
    public Collection $fieldsets;

    public function __construct(Collection $fieldsets)
    {
        $this->fieldsets = $fieldsets;
    }
    public function render()
    {
        return view('form::fieldsets');
    }
}