<?php

namespace DP\Validator;

use DP\Validator\StringLength;

class StringLengthTest extends \PHPUnit_Framework_TestCase
{
    protected function getStringLength()
    {
        return new StringLength();
    }
    
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $stringLength = $this->getStringLength();
        $this->assertInstanceOf('DP\Validator\AbstractValidator', $stringLength);
        $this->assertInstanceOf('DP\Validator\ValidatorInterface', $stringLength);
    }
    
    /**
     * @dataProvider trueProvider
     */
    public function testVerificaSeOMetodoIsValidRetornaTrue($value)
    {
        $stringLength = $this->getStringLength();
        $stringLength->setValue($value);
        $stringLength->setMin(2)
                    ->setMax(10);
        
            $this->assertTrue($stringLength->isValid());
    }
    
    public function trueProvider()
    {
        return [
            ['0123456789'],
            ['01'],
        ];
    }    
    
    /**
     * @dataProvider falseProvider
     */
    public function testVerificaSeOMetodoIsValidRetornaFalse($value)
    {
        $stringLength = $this->getStringLength();
        $stringLength->setValue($value);
        $stringLength->setMin(3)
                    ->setMax(9);
        
            $this->assertFalse($stringLength->isValid());
    }
    
    public function falseProvider()
    {
        return [
            ['0123456789'],
            ['01'],
        ];
    }
}