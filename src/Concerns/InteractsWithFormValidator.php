<?php
namespace UiBuilder\Form\Concerns;

use GetThingsDone\Attributes\Builders\RulesBuilder;

trait InteractsWithFormValidator
{

    public function validateForm()
    {
        foreach($this->getRules() as $fieldset => $rule)
        {
            $rules["values.$fieldset"] = $rule;
        }

        foreach($this->getLabels() as $fieldset => $label)
        {
            $attributes["values.$fieldset"] = $label;
        }
        
        return parent::validate(
            $rules,
            [],
            $attributes
        );
    }

    /**
     * Get the value of rules
     */ 
    public function getRules()
    {
        $rulesModel = RulesBuilder::make( $this->getModel() )->getRules();

        $this->rules = array_merge_recursive(
            $rulesModel,
            $this->rules
        );

        return $this->rules;
    }
}