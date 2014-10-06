<?php

namespace DP\Form;

class Form
{
    protected $attributes = array();
    protected $element = array();
    
    public function __construct($name=null) 
    {
        if($name !== null) {
            $this->attributes['name'] = $name;
        }
    }
    
    public function openTag()
    {
        $form = '<form';
        foreach($this->attributes as $name => $value) {
            $form .= " {$name}=\"{$value}\"";
        }
        $form .= '>';
        return $form;
    }
    
    public function closeTag() 
    {
        return '</form>';
    }
    
    public function setAttribute($name, $value) 
    {
        $this->attributes[$name] = $value;
    }
    
    public function addElement(InterfaceFormElement $element) 
    {
        $this->element[] = array('name' => $element->getName(), 'element' => $element);
    }
    
    public function render($name) 
    {
        foreach($this->element as $key => $element) {
            if($element['name'] == $name) {
                unset($this->element[$key]);
                return $element['element']->render();
            }
        }
    }
}