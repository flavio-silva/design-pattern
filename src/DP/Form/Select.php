<?php

namespace DP\Form;

class Select extends AbstractForm implements SelectInterface, RenderInterface
{
    protected $options = [];
    protected $selected;
    
    public function setValueOptions(array $options)
    {        
        $this->options = $options;
        return $this;
    }    
    
    public function render($name = null)
    {
        $html = '<select';

        foreach ($this->attributes as $name => $value) {
            $html .= " {$name}=\"{$value}\"";
        }

        $html .= '>';
        
        foreach ($this->options as $value => $option) {
            
            if($value == $this->selected) {
                $html .= "<option value=\"{$value}\" selected=\"selected\">{$option}</option>";
            } else {
                $html .= "<option value=\"{$value}\">{$option}</option>";
                
            }
            
        }

        $html .= '</select>';
        
        return $html;
    }

    public function createField(AbstractForm $field)
    {
        throw new \DomainException('You cannot put a field into another field');
    }
    
    public function setSelected($selected)
    {
        $this->selected = $selected;
        return $this;
    }
    
    public function getSelected()
    {
        return $this->selected;
    }

    public function populate(array $data)
    {        
        if(array_key_exists($this->getName(), $data)) {
            if(!is_scalar($data[$this->getName()])) {
                throw new \InvalidArgumentException('The value has passed must be of the type scalar');
            } else {
                $this->setSelected($data[$this->getName()]);
            }
        }
    }
}