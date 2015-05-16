<?php

namespace DP\Request;

use DP\Request\FactoryPost;

class FactoryPostTest extends \PHPUnit_Framework_TestCase
{
    protected function getFactoryPost()
    {
        return new FactoryPost;
    }
    
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $factory = $this->getFactoryPost();
        $this->assertInstanceOf('DP\Request\AbstractRequestMethod', $factory);
    }
    
    public function testVerificaSeOMetodoCreateRequestRetornaOObjetoCorreto()
    {
        $factory = $this->getFactoryPost();
        $this->assertInstanceOf('DP\Request\AbstractRequest', $factory->createRequest());
    }
}
