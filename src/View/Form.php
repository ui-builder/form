<?php
namespace UiBuilder\Form\View;

use Livewire\Component;
use UiBuilder\Form\Contracts\HasForm;
use UiBuilder\Form\Factories\ValidatorFactory;

class Form extends Component
{
    protected $model;

    public $fieldsets = [];

    public $rules = [];

    public $attributeNames = [];

    public $casts = [];
    
    public function mount(HasForm $model)
    {
        $this->model = $model;

        $this->fieldsets = $this->model->getFieldsets();

        $this->rules = $this->model->getRules();

        $this->attributeNames =  $this->model->getAttributeNames();

        $this->casts = $this->model->getCasts();

    }

    public function save()
    {

        $rules = [];

        foreach($this->rules as $fieldset => $rule)
        {
            $rules["fieldsets.$fieldset"] = $rule;
        }

        $this->validate(
            $rules,
            [],
            $this->attributeNames
        );

        $this->model->create(
            $this->fieldsets
        );

        $this->emitUp('refresh');

    }
    public function render()
    {
        return view('form::basic');
    }
}