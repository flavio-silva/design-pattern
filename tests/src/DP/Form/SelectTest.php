<?php

namespace DP\Form;

use DP\Form\Select;

class SelectTest extends \PHPUnit_Framework_TestCase
{
    private function getSelect($name)
    {
        return new Select($name);
    }
    
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $select = $this->getSelect('select');
        
        $this->assertInstanceOf('DP\Form\AbstractForm', $select);
        $this->assertInstanceOf('DP\Form\SelectInterface', $select);
        $this->assertInstanceOf('DP\Form\RenderInterface', $select);
    }
    
    /**
     * @expectedException \DomainException
     */
    
    public function testVerificaSeOMetodoCreateFieldLancaUmaExcessao()
    {
        $select = $this->getSelect('select');
        $select->createField($select);
    }
    
    public function testVerificaSeOMetodoRenderRetornaUmaTagValida()
    {
        $select = $this->getSelect('select');
        $this->assertRegExp('/^<select.*?<\/select>$/', $select->render());
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testVerificaSeOMetodoPopulateLancaUmaExcessao()
    {
        $select = $this->getSelect('contato');
        $select->populate(['contato' => []]);
    }
}
