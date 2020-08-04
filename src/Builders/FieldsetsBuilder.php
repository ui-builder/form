<?php
namespace UiBuilder\Form\Builders;

use UiBuilder\Form\Data\Fieldset;
use Illuminate\Support\Collection;
use UiBuilder\Form\Contracts\HasModel;
use GetThingsDone\Attributes\Attributes;
use UiBuilder\Form\Concerns\InteractsWithModel;

class FieldsetsBuilder 
{
    protected array $attributes;

    protected array $labels;

    protected array $values;
    
    protected string $key_prefix = 'values';

    protected array $inputs = [];
    
    protected array $hidden = [];
    
    public function getFieldsets($fieldsets = []): Collection
    {
        foreach($this->getAttributes() as $name => $attribute)
        {
            if( $this->isHidden($name) )
            {
                continue;
            }

            $fieldsets[] = new Fieldset([
                'name' => $name,
                'label' => $this->getLabels()[$name],
                'key' => "{$this->key_prefix}.$name",
                'value' => $this->getValues()[$name] ?? null,
                'component' => $this->getFieldsetViewComponent($attribute),
                'inputs' => $this->getInputs()[$name] ?? null
            ]);
        }

        return new Collection($fieldsets);
    }

    protected function getMapper()
    {
        return config('form.fieldsets.mapper');
    }

    protected function getFieldsetViewComponent($attribute)
    {
        if( Attributes::doesntExist($attribute) )
        {
            return null;
        }

        return $this->getMapper()[$attribute] ?? null;

    }

    /**
     * Get the value of attributes
     */ 
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Set the value of attributes
     *
     * @return  self
     */ 
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get the value of labels
     */ 
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * Set the value of labels
     *
     * @return  self
     */ 
    public function setLabels(array $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * Get the value of values
     */ 
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Set the value of values
     *
     * @return  self
     */ 
    public function setValues($values)
    {
        $this->values = $values;

        return $this;
    }

    /**
     * Get the value of inputs
     */ 
    public function getInputs(): array
    {
        return $this->inputs;
    }

    /**
     * Set the value of inputs
     *
     * @return  self
     */ 
    public function setInputs(array $inputs): self
    {
        $this->inputs = $inputs;

        return $this;
    }

    /**
     * Get the value of hidden
     */ 
    public function getHidden(): array
    {
        return $this->hidden;
    }

    /**
     * Set the value of hidden
     *
     * @return  self
     */ 
    public function setHidden(array $hidden): self
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function isHidden(string $name): bool
    {
        return in_array($name, $this->hidden);
    }
}