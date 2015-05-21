<?php

namespace DP\Form;

use DP\Form\TextArea;

class TextAreaTest extends \PHPUnit_Framework_TestCase
{
    private function getTextArea($name)
    {
        return new TextArea($name);
    }
    
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $textArea = $this->getTextArea('text-area');
        $this->assertInstanceOf('DP\Form\AbstractForm', $textArea);
        $this->assertInstanceOf('DP\Form\RenderInterface', $textArea);
        $this->assertInstanceOf('DP\Form\TextAreaInterface', $textArea);
    }
    
    /**
     * @expectedException \DomainException
     */
    public function testVerificaSeOMetodoCreateFieldLancaUmaExcessao()
    {
        $textArea = $this->getTextArea('text-area');
        $textArea->createField($textArea);
    }
    
    public function testVerificaSeOMetodoRenderRetornaUmaTagValida()
    {
        $textArea = $this->getTextArea('text-area');
        $tag = $textArea->render();
        $this->assertRegExp('/^<textarea.*?<\/textarea>$/', $tag);
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testVerificaSeOMetodoPopulateLancaUmaExcessao()
    {
        $textArea = $this->getTextArea('text-area');
        $textArea->populate([
            'text-area' => []
        ]);
    }
    /**
     * @dataProvider getProvider
     */
    public function testVerificaSeOMetodoPopulateSetaOContent($value)
    {
        $textArea = $this->getTextArea('text-area');
        $textArea->populate(['text-area'=> $value]);
        $this->assertEquals($value, $textArea->getContent());
    }
    
    public function getProvider()
    {
        return [
            ['message1'],
            ['message2'],
            ['message3'],
            ['message4'],
        ];
    }
}
