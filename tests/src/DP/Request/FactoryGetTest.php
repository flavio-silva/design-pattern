<?php

namespace DP\Request;

use DP\Request\FactoryGet;

class FactoryGetTest extends \PHPUnit_Framework_TestCase
{
    protected function getFactoryGet()
    {
        return new FactoryGet;
    }
    
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $factory = $this->getFactoryGet();
        $this->assertInstanceOf('DP\Request\AbstractRequestMethod', $factory);
    }
    
    public function testVerificaSeOMetodoCreateRequestRetornaOObjetoCorreto()
    {
        $factory = $this->getFactoryGet();
        $this->assertInstanceOf('DP\Request\AbstractRequest', $factory->createRequest());
    }
}
