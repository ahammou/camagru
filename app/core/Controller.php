<?php

class Controller
{
    protected $view;
    protected $model;

    protected function model($model)
    {
        if (file_exists(MODEL . $model . "Model.php"))
        {
            require_once(MODEL . $model . "Model.php");
            return new $model();
        }
        else
            echo("this model doesn't exist");
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