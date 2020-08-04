<?php
namespace UiBuilder\Form\Contracts;

use GetThingsDone\Attributes\Contracts\HasCastAttributes;

interface HasModel
{
    public function getModel();

    public function setModel(HasCastAttributes $model);
}