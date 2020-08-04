<?php
namespace UiBuilder\Form\Views;

use Livewire\Component;
use UiBuilder\Form\Contracts\HasModel;
use GetThingsDone\Attributes\Attributes;
use UiBuilder\Form\Contracts\HasFieldsets;
use UiBuilder\Form\Contracts\HasFormValidator;
use UiBuilder\Form\Concerns\InteractsWithModel;
use GetThingsDone\Attributes\Builders\RulesBuilder;
use UiBuilder\Form\Concerns\InteractsWithFieldsets;
use UiBuilder\Form\Concerns\InteractsWithFormValidator;
use GetThingsDone\Attributes\Contracts\HasCastAttributes;

class Form extends Component implements HasModel, HasFieldsets, HasFormValidator
{
    use InteractsWithModel, InteractsWithFieldsets, InteractsWithFormValidator;

    public array $values = [];

    public $image;
    
    protected array $labels = [];

    protected array $inputs = [];
    
    protected array $hidden = [
        'id','created_at','updated_at','deleted_at'
    ];

    protected array $rules = [];

    public function mount(HasCastAttributes $model)
    {
        $this->setModel(  $model );
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