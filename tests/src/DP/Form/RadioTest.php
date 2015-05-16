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
}
