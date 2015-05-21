<?php

namespace DP\Request;

class GetTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $get = new Get();        
        $this->assertInstanceOf('DP\Request\AbstractRequest', $get);
    }
}
