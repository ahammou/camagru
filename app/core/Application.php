<?php

class Application
{
    protected   $controller = 'home';
    protected   $action = 'index';
    protected   $params = [];

    /**
     * __construct -> parses the url, checks if the controller file exists, instanciates the object and start the controller's action
     */
    public function __construct()
    {
        $this->parseUrl();
        if (file_exists(CONTROLLER . $this->controller . '.php'))
        {
            $this->controller = new $this->controller;
            if (method_exists($this->controller, $this->action))
            {
               call_user_func_array([$this->controller, $this->action], $this->params);
               //$this->controller->index();
            }
        }
    }

    /**
     * parseUrl -> 
     */
    protected function parseUrl()
    {
        print_r($_SERVER['REQUEST_URI']);
        $request = trim($_SERVER['REQUEST_URI'], '/');
        if (!empty($request))
        {
            $url = array_slice(explode('/', $request), 2);

            $this->controller = $url[0] ? ucfirst($url[0]) . 'Controller' : ucfirst($this->controller) . 'Controller';
            $this->action = $url[1] ? $url[1] :  $this->action;
            $this->params = $url[0] && $url[1] ? array_slice($url, 2) : [];

            // echo "controller " . $this->controller."<br> action: ".$this->action."<br> params: ";
            // var_dump($this->params);
        }
    }
}