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

    public string $saveAction = 'create';

    public function mount(HasForm $model)
    {
        $this->setModel(  $model );
        $this->setTypes();  
        $this->setFieldsets();
        $this->rules = $this->getModel()->getRules();
        $this->attributeNames =  $this->getModel()->getAttributeNames();
    }

    protected $listeners = [
        'showModel' => 'showModel',
        'createModel' => 'createModel'
    ];

    public function showModel($id)
    {
        $this->model = $this->getModel()->find($id);

        $this->setFieldsets();
        $this->saveText = 'Update';
        $this->saveAction = "update";
        $this->resetValidation();

    }

    public function createModel()
    {
        $this->setFieldsets();
        $this->saveText = 'Create';
        $this->saveAction = 'create';
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        $this->getModel()->create(
            $this->fieldsets
        );

        $this->emit('modelsCollectionRefresh');
    }

    public function update()
    {
        $this->validate();

        $this->getModel()->find(
            $this->fieldsets['id']
        )->update(
            $this->fieldsets
        );

        $this->emit('modelsCollectionRefresh');
    }

    public function render()
    {
        return view('form::basic');
    }

    protected function setTypes(): self
    {
        if(!$this->getModel() instanceof HasTypes)
        {
            return $this;
        }

        $types = [];
        
        foreach($this->getModel()->getCasts() as $fieldset => $type)
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
        $fieldsets = [
            'id' => $this->getModel()->id ?? null
        ];

        foreach($this->getModel()->getFieldsets() as $fieldset)
        {
            if( !isset($this->types[$fieldset]) )
            {
                continue;
            }

            $fieldsets[$fieldset] = $this->getModel()->{$fieldset};
        }

        $this->fieldsets = $fieldsets;

        return $this;
    }

    public function validate($rules = [], $messages = [], $attributes = [])
    {
        foreach($this->rules as $fieldset => $rule)
        {
            $rules["fieldsets.$fieldset"] = $rule;
        }

        foreach($this->attributeNames as $fieldset => $name)
        {
            $attributes["fieldsets.$fieldset"] = $name;
        }
        
        return parent::validate(
            $rules,
            [],
            $attributes
        );
    }

    /**
     * Get the value of model
     */ 
    public function getModel()
    {
        return $this->model ?? new $this->modelClassname;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */ 
    public function setModel($model)
    {
        $this->model = $model;
        $this->modelClassname =  $this->modelClassname ?? get_class($this->model);
        return $this;
    }
}