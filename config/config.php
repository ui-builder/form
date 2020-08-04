<?php

/*
 * You can place your custom package configuration in here.
 */


return [
    'fieldsets' => [
        'mapper' => [
            \GetThingsDone\Attributes\Attributes\Code::class => \UiBuilder\Form\Views\Inputs\Textbox::class,
            \GetThingsDone\Attributes\Attributes\Name::class => \UiBuilder\Form\Views\Inputs\Textbox::class,
            \GetThingsDone\Attributes\Attributes\Text::class => \UiBuilder\Form\Views\Inputs\Textbox::class,
            // \GetThingsDone\Attributes\Attributes\Image::class => \UiBuilder\Form\Views\Inputs\Image::class,
        ]
    ]
];