<?php

namespace DP\Form;

use PHPUnit_Framework_TestCase;
use DP\Form\FieldSet;

class FieldSetTest extends PHPUnit_Framework_TestCase
{
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $fieldset = new FieldSet('test');
        $this->assertInstanceOf("DP\Form\RenderTagsInterface", $fieldset);
        $this->assertInstanceOf('DP\Form\AbstractForm', $fieldset);
    }
    
    public function testVerificaSeRetornaUmaTagHtml()
    {
        $fieldset = new FieldSet('test');
        $this->assertRegExp('/^<fieldset.*>$/', $fieldset->openTag());
        $this->assertEquals('</fieldset>', $fieldset->closeTag());
    }
}
