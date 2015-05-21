<?php

namespace DP\Request;

class PostTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaSeOTipoDaClasseEstaCorreto()
    {
        $post = new Post();
        $this->assertInstanceOf('DP\Request\AbstractRequest', $post);
    }
}
