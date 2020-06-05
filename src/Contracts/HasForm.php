<?php
namespace UiBuilder\Form\Contracts;

interface HasForm 
{
    public function getCasts();
    
    public function getFieldsets();
    
    public function getRules();

    public function getAttributeNames();
}