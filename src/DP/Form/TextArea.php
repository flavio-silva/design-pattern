<?php

namespace DP\Form;

class TextArea extends AbstractForm  implements RenderInterface, TextAreaInterface
{
    private $content;
    
    public function render($name = null)
    {
        $html = '<textarea';
        foreach ($this->attributes as $name => $value) {
            $html .= " {$name}=\"{$value}\"";
        }
        $html .= '>';
        
        $html .= $this->content;
        
        $html .= '</textarea>';

        return $html;
    }

    public function createField(AbstractForm $field)
    {
        throw new \DomainException('You cannot put a field into another field');
    }
    
    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

        
    public function populate(array $data)
    {
        if(array_key_exists($this->getName(), $data)) {
            
            if(!is_scalar($data[$this->getName()])) {
                throw new \InvalidArgumentException('The value must be of the type scalar');
            } else {
                $this->setContent($data[$this->getName()]);;
            }
        }
    }
}
