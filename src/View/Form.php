<?php
namespace UiBuilder\Form\View;

use Livewire\Component;
use GetThingsDone\Attributes\Attributes;
use UiBuilder\Form\Contracts\HasForm;
use GetThingsDone\Attributes\Contracts\HasAttributes;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Form extends Component
{
    protected $model;

    public $fieldsets = [];

    public $rules = [];

    public $attributeNames = [];

    public $attributes = [];
    
    public string $modelClassname;

    public string $saveText = 'Create';

    public string $saveAction = 'create';

    public function mount(HasForm $model)
    {
        $this->setModel(  $model );
        $this->setAttributes();  
        $this->setFieldsets();
        $this->rules = $this->getModel()->getRules();
        $this->attributeNames =  $this->getModel()->getAttributeNames();

        $this->createModel();
    }

    protected $listeners = [
        'showModel' => 'showModel',
        'createModel' => 'createModel'
    ];

    public function showModel($id)
    {
        $this->model = $this->getModel()->find($id);

        $this->setFieldsets();
        $this->saveText = __('attributes::action.update');
        $this->saveAction = "update";
        $this->resetValidation();

    }

    public function createModel()
    {
        $this->setFieldsets();
        $this->saveText = __('attributes::action.create');;
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

    protected function setAttributes(): self
    {
        if(!$this->getModel() instanceof HasAttributes)
        {
            return $this;
        }

        $attributes = [];
        
        foreach($this->getModel()->getCasts() as $fieldset => $attribute)
        {
            if( Attributes::exists($attribute) )
            {
                $attributes[$fieldset] = (new $attribute)->getAlias() ;
                continue;
            }

            $attributes[$fieldset] = $attribute;
        }

        $this->attributes = $attributes;

        return $this;
    }

    protected function setFieldsets(): self
    {
        $fieldsets = [
            'id' => $this->getModel()->id ?? null
        ];

        foreach($this->getModel()->getFieldsets() as $fieldset)
        {
            if( !isset($this->attributes[$fieldset]) )
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