<?php

namespace DP\Validator;

use DP\Validator\Currency;

class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    protected function getCurrency()
    {
        return new Currency();
    }
    
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $currency = $this->getCurrency();
        $this->assertInstanceOf('DP\Validator\AbstractValidator', $currency);
        $this->assertInstanceOf('DP\Validator\ValidatorInterface', $currency);
    }
    /**
     * @dataProvider trueProvider
     */
    public function testVerificaSeOMetodoIsValidRetornaTrue($value)
    {
        $currency = $this->getCurrency();
        $currency->setValue($value);
        $this->assertTrue($currency->isValid());
    }
    
    public function trueProvider()
    {
        return [
            ['10,00'],
            ['100'],
            ['1,00'],
            ['23'],
            ['22,39']
        ];
    }
    /**
     * @dataProvider falseProvider
     */
    public function testVerificaSeOMetodoIsValidRetornaFalse($value)
    {
        $currency = $this->getCurrency();
        $currency->setValue($value);
        $this->assertFalse($currency->isValid());
    }
    
    public function falseProvider()
    {
        return [
            ['10.00'],
            ['10,000'],
            ['123,0'],
            ['text'],
        ];
    }
}
