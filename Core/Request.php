<?php

namespace Core;

class Request{
    public array $routeParams = [];
    public function method()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }
    public function geturi()
    {
        if(strpos($_SERVER["REQUEST_URI"],'?')){
            return substr($_SERVER["REQUEST_URI"],0,strpos($_SERVER["REQUEST_URI"],'?'));
        } else{
            return $_SERVER["REQUEST_URI"];
        }
    }
    public function setRouteParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }

}