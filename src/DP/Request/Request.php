<?php

namespace DP\Request;

class Request 
{
    private $method = 'GET';

    public function __construct()
    {
        if(isset($_SERVER['REQUEST_METHOD'])) {
            $this->method = $_SERVER['REQUEST_METHOD'];
        }
    }

    public function isPost()
    {
        if($this->method == 'POST') {
            return true;
        }

        return false;
    }

    public function isGet()
    {
        if($this->method == 'GET') {
            return true;
        }

        return false;
    }

    /**
     * @return Post
     */
    public function getPost()
    {
        $factory = new FactoryPost();
        return $factory->getRequestMethod();
    }

    /**
     * @return Get
     */

    public function getGet()
    {
        $factory = new FactoryGet();
        return $factory->getRequestMethod();
    }
}