<?php

namespace DP\Validator;

use DP\Validator\InArray;

class InArrayTest extends \PHPUnit_Framework_TestCase
{
    protected function getInArray()
    {
        return new InArray();
    }
    
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $inArray = $this->getInArray();
        
        $this->assertInstanceOf('DP\Validator\AbstractValidator', $inArray);
        $this->assertInstanceOf('DP\Validator\ValidatorInterface', $inArray);
    }
    
    public function testVerificaSeOMetodoIsValidRetornaTrue()
    {
        $inArray = $this->getInArray();
        $inArray->setData(['SomeValue', 'OtherValue']);
        $inArray->setValue('SomeValue');
        $this->assertTrue($inArray->isValid());
    }
    
    public function testVerificaSeOMetodoIsValidRetornaFalse()
    {
        $inArray = $this->getInArray();
        $inArray->setData(['OtherValue']);
        $inArray->setValue('SomeValue');
        $this->assertFalse($inArray->isValid());
    }
    
}
