<?php
namespace UiBuilder\Form\View;

use Livewire\Component;
use UiBuilder\Form\Contracts\HasModel;
use GetThingsDone\Attributes\Attributes;
use UiBuilder\Form\Contracts\HasFieldsets;
use UiBuilder\Form\Concerns\InteractsWithModel;
use GetThingsDone\Attributes\Builders\RulesBuilder;
use UiBuilder\Form\Concerns\InteractsWithFieldsets;
use GetThingsDone\Attributes\Contracts\HasCastAttributes;

class Form extends Component implements HasModel, HasFieldsets
{
    use InteractsWithModel, InteractsWithFieldsets;

    public $rules = [];
    
    public array $values = [];

    protected $labels = [];

    public function mount(HasCastAttributes $model)
    {
        $this->setModel(  $model );
        $this->setRules();
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
        $this->validateForm();

        $model = $this->getModel()->create(
            $this->fieldsets
        );

        $this->emit('modelsCollectionRefresh');
        $this->createModel($model->id);
    }

    public function update()
    {
        $this->validateForm();

        $model = $this->getModel()->find(
            $this->fieldsets['id']
        );
        $model->update(
            $this->fieldsets
        );

        $this->emit('modelsCollectionRefresh');
        $this->showModel($model->id);
    }

    public function render()
    {
        return view('form::basic');
    }

    public function getLabels(): array
    {
        $labels = array_merge(
            $this->getModel()->getAttributeNames(),
            $this->labels
        );

        return $labels;
    }
}