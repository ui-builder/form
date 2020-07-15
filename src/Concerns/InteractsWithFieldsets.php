<?php
namespace UiBuilder\Form\Concerns;

use Illuminate\Support\Collection;
use UiBuilder\Form\Builders\FieldsetsBuilder;

trait InteractsWithFieldsets
{
    protected array $inputs = [];
    
    public function getFieldsetsProperty(FieldsetsBuilder $builder): Collection
    {
        $model = $this->getModel();
        $attributes = $model->getCasts();
        $labels = $this->getLabels();
        
        $fieldsets = $builder
                        ->setAttributes($attributes)
                        ->setLabels($labels)
                        ->setValues($this->values)
                        ->setInputs($this->inputs)
                        ->getFieldsets();

        return $fieldsets;
    }
}