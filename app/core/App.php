<?php

class App
{
    protected   $controller = 'HomeController';
    protected   $method = 'index';
    protected   $params = [];

    /**
     * __construct -> parses the url, checks if the controller file exists, 
     * instanciates the object and start the controller's method if it exists
     */
    public function __construct()
    {
       $url = $this->parseUrl();

        if (file_exists(CONTROLLER . ucfirst($url[0]) . 'Controller.php'))
        {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        require_once(CONTROLLER . $this->controller) . '.php';

        $this->controller = new $this->controller;

        if (isset($url[1]))
        {
            if (method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url): []; //array_values() => rebases indexes
        
        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    /**
     * parseUrl -> 
     */
    protected function parseUrl()
    {
        if (isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');
            return explode('/', filter_var($url, FILTER_SANITIZE_URL));
        }
    }
}