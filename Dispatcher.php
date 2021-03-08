<?php

namespace MVC;

use MVC\Request;
use MVC\Router;

class Dispatcher
{
    private $request;

    // Navigate to Controller
    public function dispatch()
    {
        $this->request = new Request();
        
        Router::parse($this->request->url, $this->request);
        
        $controller = $this->loadController();

        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }
    public function loadController()
    {
        $name = ucfirst($this->request->controller) . "Controller";
        $file = "MVC\\Controllers\\" . $name;
        $controller = new $file();
        return $controller;
    }
}
