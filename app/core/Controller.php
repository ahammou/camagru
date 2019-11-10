<?php

class Controller
{
    protected $view;
    protected $model;

    protected function model($model)
    {
        require_once(MODEL . $model . "Model.php");
        return new $model();
    }

    public function view($view, $data = [])
    {
        if (file_exists(VIEW . $view . ".view.php"))
        {
            require_once(VIEW . $view . ".view.php");
        }
        return new View($view, $data);
    }


}