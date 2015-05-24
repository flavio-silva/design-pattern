<?php

namespace DP\Form;

use DP\Validator\Validator;

class Form extends AbstractForm implements RenderTagsInterface
{
    protected $validator;
    protected $data = [];
    
    public function __construct(Validator $validator, $name)
    {
        $this->validator = $validator;
        parent::__construct($name);
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
    
    public function isValid()
    {
        return $this->validator->isValid();
    }
    /**
     * @return \DP\Validator\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }
    
    public function populate(array $data)
    {
        parent::populate($data);
        $this->validator->populate($data);
    }
}