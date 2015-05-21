<?php

namespace DP\Form;

use DP\Form\Radio;

class RadioTest extends \PHPUnit_Framework_TestCase
{
    private function getRadio($name)
    {
        return new Radio($name);
    }

    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $radio = $this->getRadio('radio');
        $this->assertInstanceOf('DP\Form\RenderInterface', $radio);
        $this->assertInstanceOf('DP\Form\AbstractForm', $radio);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    
    public function testVerificaSeOMetodoRenderLancaUmaExcessao()
    {
        $radio = $this->getRadio('radio');
        $radio->render();
    }
    /**
     * 
     * @dataProvider getProvider
     */
    public function testVerificaSeOMetodoPopulateSetaOSelected($value)
    {
        $radio = $this->getRadio('radio');
        $radio->populate(['radio' => $value]);
        $this->assertEquals($value, $radio->getSelected());
    }
    
    public function getProvider()
    {
        return [
            ['m'],
            ['f'],
            ['masculino'],
            ['feminino'],
        ];
    }
    
    public function testVerificaSeOMetodoSetAttributeEGetValuesFuncionam()
    {
        $radio = $this->getRadio('radio');
        $radio->setAttribute('value', 'f')
            ->setAttribute('value', 'm')
        ;
        
        $this->assertArrayHasKey('f', $radio->getValues());
        $this->assertArrayHasKey('m', $radio->getValues());
        
        $this->assertEquals('f', $radio->getValues()['f']);
        $this->assertEquals('m', $radio->getValues()['m']);
        
    }
}
