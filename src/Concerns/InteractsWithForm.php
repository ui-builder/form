<?php
namespace UiBuilder\Form\Concerns;

trait InteractsWithForm
{

    public function getFieldsets()
    {
        return $this->getFillable();
    }

    protected function getRulesDefault()
    {
        $attribute = $this->getFielsets();
    }

    public function getRules()
    {

    }

    public function getAttributeNames()
    {

    }
}