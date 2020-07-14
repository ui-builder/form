<?php
namespace UiBuilder\Form\Data;

class Fieldset
{
    public string $name;

    public ?string $label;

    public ?string $component;

    public string $key;

    public ?string $value;

    public array $data;

    public function __construct(array $fieldset)
    {
        $this->name = $fieldset['name'];
        $this->label = $fieldset['label'] ?? null;
        $this->component = $fieldset['component'] ?? null;
        $this->key = $fieldset['key'];
        $this->value = $fieldset['value'] ?? null;

        $this->data = [
            'name' => $this->key,
            'value' => $this->value
        ];

        
    }
}