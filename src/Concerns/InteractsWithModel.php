<?php
namespace UiBuilder\Form\Concerns;

use GetThingsDone\Attributes\Contracts\HasCastAttributes;

trait InteractsWithModel
{

    protected HasCastAttributes $model;

    public string $modelClassname;

    /**
     * Get the value of model
     */ 
    public function getModel()
    {
        return $this->model ?? new $this->modelClassname;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */ 
    public function setModel(HasCastAttributes $model)
    {
        $this->model = $model;
        $this->modelClassname =  $this->modelClassname ?? get_class($this->model);
        return $this;
    }
}