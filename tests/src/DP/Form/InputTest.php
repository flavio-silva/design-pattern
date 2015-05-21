<?php

namespace DP\Form;

use DP\Form\Input;

class InputTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $input = $this->getInput('input');
        $this->assertInstanceOf('DP\Form\RenderInterface', $input);
        $this->assertInstanceOf('DP\Form\AbstractForm', $input);
    }
    
    /**
     * @expectedException \DomainException
     */
    public function testVerificaSeOMetodoCreateFieldLancaUmaExcessao()
    {
        $input = $this->getInput('input');
        $input->createField($input);
    }
    
    public function testVerificaSeOMetodoRenderRetornaUmaTagValida()
    {
        $input = $this->getInput('input');
        $tag = $input->render();
        $this->assertRegExp('/^<.*?>$/', $tag);
    }
    /**
     * @dataProvider getProvider
     */
    public function testVerificaSeOMetodoPopulateSetaOAtributoValue($value)
    {
        $input = $this->getInput('input');
        $input->populate(['input' => $value]);
        $this->assertEquals($value, $input->getAttribute('value'));
    }

    public function getProvider()
    {
        return [
            [10],
            [1],
            [3],
            [110],
        ];
    }
        
    private function getInput($name)
    {
        return new Input($name);
    }
}