<?php
namespace UiBuilder\Form\View;

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

    public array $rules = [];

    public array $values = [];

    protected array $labels = [];

    public function mount(HasCastAttributes $model)
    {
        $this->setModel(  $model );
        $this->setRules();
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