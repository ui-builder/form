<?php
namespace UiBuilder\Form\Concerns;

use Illuminate\Support\Collection;
use UiBuilder\Form\Builders\FieldsetsBuilder;

trait InteractsWithFieldsets
{
    public function getFieldsetsProperty(): Collection
    {
        $builder = app(FieldsetsBuilder::class);
        $model = $this->getModel();
        $attributes = $model->getCasts();
        $labels = $this->getLabels();
        
        $fieldsets = $builder
                        ->setAttributes($attributes)
                        ->setLabels($labels)
                        ->setValues($this->values)
                        ->setInputs($this->inputs)
                        ->setHidden($this->hidden)
                        ->getFieldsets();
        return $fieldsets;
    }
}