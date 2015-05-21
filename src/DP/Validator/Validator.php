<?php

namespace DP\Validator;

use DP\Request\Request;

class Validator extends AbstractValidator
{
    protected $request;
    /**
     * @var ValidatorInterface | array
     */
    protected $validators = [];    
    protected $messages = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function add(ValidatorInterface $validator)
    {
        $this->validators[$validator->getName()] = $validator;
        return $this;
    }
    
    public function getValidators()
    {
        return $this->validators;
    }
    
    public function isValid()
    {
        $return = true;
        foreach ($this->validators as $name => $validator) {
            if(!$validator->isValid()) {
                $this->messages[$name] = $validator->getMessage();
                $return = false;
            }
        }
        
        return $return;        
    }
    
    public function getMessages()
    {
        return $this->messages;
    }
    
    public function populate(array $data)
    {
        foreach ($this->validators as $name => $validator) {
            if(array_key_exists($name, $data)) {
                $validator->setValue($data[$name]);
                $this->add($validator);
            }
        }
    }
}