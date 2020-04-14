<?php

namespace UiBuilder\Form;

use Illuminate\Support\Facades\Facade;

/**
 * @see \UiBuilder\Form\Skeleton\SkeletonClass
 */
class FormFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'form';
    }
}
