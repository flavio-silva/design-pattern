<?php

namespace DP\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{    
    public function getValidator()
    {
        return new Validator($this->getRequestMock());
    }
    
    public function getRequestMock()
    {
        $request = $this->getMock('DP\Request\Request');
        return $request;
    }
    
    public function getCurrency()
    {
        $currency = $this->getMock('DP\Validator\Currency', ['isValid', 'getName']);
        $currency->expects($this->any())
                ->method('isValid')
                ->willReturn(true);
        
        $currency->expects($this->any())
                ->method('getName')
                ->willReturn('currency');
        return $currency;
    }
    
    public function getStringLength()
    {
        $stringLength = $this->getMock('DP\Validator\Currency', ['isValid', 'getName']);
        $stringLength->expects($this->any())
                ->method('isValid')
                ->willReturn(true);
        
        $stringLength->expects($this->any())
                ->method('getName')
                ->willReturn('stringLength');
        return $stringLength;
    }
    
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $validator = $this->getValidator();
        $this->assertInstanceOf('DP\Validator\AbstractValidator', $validator);
    }
    
    public function testVerificaSeOMetodoAddFunciona()
    {
        $validator = $this->getValidator();
        $validator->add($this->getStringLength());
        $validator->add($this->getCurrency());
        
        $validators = $validator->getValidators();
        
        $this->assertArrayHasKey('stringLength', $validators);
        $this->assertArrayHasKey('currency', $validators);
    }
    
    public function testVerificaSeOMetodoIsValidRetornaTrue()
    {
        $validator = $this->getValidator();
        $validator->add($this->getStringLength());
        $validator->add($this->getCurrency());
        
        $this->assertTrue($validator->isValid());
    }
    
}