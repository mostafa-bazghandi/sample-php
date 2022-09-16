<?php

namespace Core;

class Controller{
    public function render($view,$data=[],$data1 = null)
    {
        return Application::$app->routing->renderview($view,$data,$data1);
    }

}