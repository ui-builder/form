<?php
namespace UiBuilder\Form\Concerns;

use Illuminate\Support\Collection;
use UiBuilder\Form\Builders\FieldsetsBuilder;

trait InteractsWithFieldsets
{
    
    public function getFieldsetsProperty(FieldsetsBuilder $builder): Collection
    {
        $model = $this->getModel();
        $attributes = $model->getCasts();
        $labels = $this->getLabels();
        
        $fieldsets = $builder
                        ->setAttributes($attributes)
                        ->setLabels($labels)
                        ->setValues($this->values)
                        ->getFieldsets();

        return $fieldsets;
    }
}