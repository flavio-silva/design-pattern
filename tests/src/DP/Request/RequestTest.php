<?php

namespace DP\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function getRequest()
    {
        return new Request();
    }
    
    public function testVerificaSeOMetodoIsGetRetornaTrue()
    {
        $request = $this->getRequest();        
        $this->assertTrue($request->isGet());
    }
    
    public function testVerificaSeOMetodoIsPostRetornaFalse()
    {
        $request = $this->getRequest();
        $this->assertFalse($request->isPost());
    }
    
    public function testVerificaSeOMetodoGetPostRetornaTipoValido()
    {
        $request = $this->getRequest();
        $this->assertInstanceOf('DP\Request\AbstractRequest', $request->getPost());
    }
    
    public function testVerificaSeOMetodoGetGetRetornaTipoValido()
    {
        $request = $this->getRequest();
        $this->assertInstanceOf('DP\Request\AbstractRequest', $request->getGet());
    }    
}