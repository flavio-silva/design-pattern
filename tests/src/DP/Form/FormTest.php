<?php

namespace DP\Form;

class FormTest extends \PHPUnit_Framework_TestCase
{
    public function getForm()
    {
        $validator = $this->getMockBuilder('\DP\Validator\Validator')
                        ->disableOriginalConstructor()
                        ->getMock();
        
        $validator->expects($this->any())
                ->method('isValid')
                ->willReturn(true);
        
        
        return new \DP\Form\Form($validator, 'form');
    }
    
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {        
        $form = $this->getForm();
        $this->assertInstanceOf('\DP\Form\RenderTagsInterface', $form);
        $this->assertInstanceOf('\DP\Form\AbstractForm', $form);
    }
    
    public function testVerificaSeOMetodoOpenTagRetornaUmaTagValida()
    {
        $form = $this->getForm();        
        $this->assertRegExp('/^<form.*?>$/', $form->openTag());
    }
    
    public function testVerificaSeOMetodoCloseTagRetornaUmaTagValid()
    {
        $form = $this->getForm();        
        $this->assertEquals('</form>', $form->closeTag());
    }
    
    public function testVerificaSeOMetodoIsValidFunciona()
    {
        $form = $this->getForm();
        $this->assertTrue($form->isValid());
    }
    
    public function testVerificaSeOMetodoGetValidatorFunciona()
    {
        $form = $this->getForm();
        $this->assertInstanceOf('\DP\Validator\Validator',$form->getValidator());
    }
}
