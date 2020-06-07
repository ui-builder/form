<?php
namespace UiBuilder\Form\View;

use Livewire\Component;
use GetThingsDone\Types\Types;
use UiBuilder\Form\Contracts\HasForm;
use GetThingsDone\Types\Contracts\HasTypes;
use UiBuilder\Form\Factories\ValidatorFactory;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Form extends Component
{
    protected $model;

    public $fieldsets = [];

    public $rules = [];

    public $attributeNames = [];

    public $types = [];
    
    public string $modelClassname;

    public string $saveText = 'Create';

    public function mount(HasForm $model)
    {
        $this->model = $model;
        $this->modelClassname = get_class($this->model);
        $this->setTypes();  
        $this->setFieldsets();
        $this->rules = $this->model->getRules();
        $this->attributeNames =  $this->model->getAttributeNames();
    }

    protected $listeners = [
        'showModel' => 'showModel',
        'createModel' => 'createModel'
    ];

    public function showModel($id)
    {
        $this->model = new $this->modelClassname;
        $this->model = $this->model->find($id);
        $this->setFieldsets();
        $this->saveText = 'Edit';
        $this->resetValidation();

    }

    public function createModel()
    {
        $this->model = new $this->modelClassname;
        $this->setFieldsets();
        $this->saveText = 'Create';
        $this->resetValidation();
    }

    public function save()
    {

        $rules = [];

        foreach($this->rules as $fieldset => $rule)
        {
            $rules["fieldsets.$fieldset"] = $rule;
        }


        $attributeNames = [];
        foreach($this->attributeNames as $fieldset => $name)
        {
            $attributeNames["fieldsets.$fieldset"] = $name;
        }
        
        $this->validate(
            $rules,
            [],
            $attributeNames
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

    protected function setTypes(): self
    {
        if(!$this->model instanceof HasTypes)
        {
            return $this;
        }

        $types = [];
        
        foreach($this->model->getCasts() as $fieldset => $type)
        {
            if( Types::exists($type) )
            {
                $types[$fieldset] = (new $type)->getAlias() ;
                continue;
            }

            $types[$fieldset] = $type;
        }

        $this->types = $types;

        return $this;
    }

    protected function setFieldsets(): self
    {
        $fieldsets = [];

        foreach($this->model->getFieldsets() as $fieldset)
        {
            if( !isset($this->types[$fieldset]) )
            {
                continue;
            }

            $fieldsets[$fieldset] = $this->model->{$fieldset};
        }

        $this->fieldsets = $fieldsets;
        return $this;
    }
}