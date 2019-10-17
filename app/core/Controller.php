<?php

class Controller
{
    protected $view;
    protected $model;

    public function view($viewFile, $viewData = [])
    {
        $this->view = new View($viewFile, $viewData);
        return $this->view;
    }


}