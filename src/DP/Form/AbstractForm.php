<?php

namespace DP\Form;

abstract class AbstractForm
{
    protected $attributes = [] ;
    /**
     * @var AbstractForm | array
     */
    protected $fields = [];
    protected $label;

    public function __construct($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }
    
    public function getAttribute($name)
    {
        if(array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
        
        throw new \InvalidArgumentException("There's no attribute named {$name}");
    }

    public function createField(AbstractForm $field)
    {
        $this->fields[$field->getName()] = $field;

        return $this;
    }
    
    public function getField($name)
    {
        if(array_key_exists($name, $this->fields)) {
            return $this->fields[$name];
        }
        
        throw new \InvalidArgumentException("There is not a field named \"{$name}\"");
    }
    
    public function populate(array $data)
    {
        foreach ($this->fields as $field) {
            $field->populate($data);
        }
    }
    
} 