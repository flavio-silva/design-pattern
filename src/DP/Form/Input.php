<?php

namespace DP\Form;

class Input extends AbstractForm implements RenderInterface
{
    public function render($name = null)
    {
        $html = '<input';

        foreach($this->attributes as $name => $valor) {
            $html .= " {$name}=\"$valor\"";
        }

        $html .= '>';

        return $html;
    }

    public function createField(AbstractForm $field)
    {
        throw new \DomainException('You cannot put a field into another field');
    }
    
    public function populate(array $data)
    {
        if(array_key_exists($this->getName(), $data)) {
            $this->setAttribute('value', $data[$this->getName()]);
        }
    }
}