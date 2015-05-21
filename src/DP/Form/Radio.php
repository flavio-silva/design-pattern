<?php

namespace DP\Form;

class Radio extends AbstractForm implements RenderInterface
{    
    protected $values = [];
    protected $selected;
    
    public function render($value = null)
    {        
        if(array_key_exists($value, $this->values)) {
            
            $output = "<input type=\"radio\" value=\"{$value}\"";
            
            if($this->selected == $value) {
                $output .= " checked=\"checked\" ";
            }
            
            foreach($this->attributes as $name => $value) {
                $output .= "{$name}=\"{$value}\"  \>";
            }
            
            return $output;
        }
        
        throw new \InvalidArgumentException('The parameter "value" does not a valid value');
        
    }
    
    public function setAttribute($name, $value)
    {
        switch ($name) {
            case 'value':
                $this->values[$value] = $value;
                break;            
            default:
                $this->attributes[$name] = $value;
        }        
        return $this;
    }
    
    public function populate(array $data)
    {
        if(array_key_exists($this->getName(), $data)) {            
            $this->setSelected($data[$this->getName()]);
        }
    }
    
    public function getSelected()
    {
        return $this->selected;
    }
    
    public function setSelected($selected)
    {
        $this->selected = $selected;
    }
    
    public function getValues()
    {
        return $this->values;
    }
}