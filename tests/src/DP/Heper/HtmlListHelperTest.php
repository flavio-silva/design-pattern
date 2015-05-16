<?php

namespace DP\Helper;

use DP\Helper\HtmlListHelper;

class HtmlListHelperTest extends \PHPUnit_Framework_TestCase
{
    protected function getHelper()
    {
        return new HtmlListHelper();
    }
    
    public function testVerificaSeOMetodoHtmlListRetornaUmaTagValida()
    {
        $helper = $this->getHelper();
        
        $fruits = [
            'apple', 'orange', 'banana', 'strawberry', 'lemon'
        ];
        
        $this->assertRegExp('/^<ul><li>.*<\/li><\/ul>$/', $helper->htmlList($fruits));
    }
    
}
