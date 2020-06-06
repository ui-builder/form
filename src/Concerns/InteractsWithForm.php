<?php
namespace UiBuilder\Form\Concerns;

trait InteractsWithForm
{
    public function getFieldsets()
    {
        return $this->getFillable();
    }
}