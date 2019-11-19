<?php

abstract class Controller
{
    protected $view;
    protected $model;
    protected $manager;

    protected function model($model)
    {
        if (file_exists(MODEL . $model . "Model.php"))
        {
            require_once(MODEL . $model . "Model.php");
            $this->model = $model . "Model";
            return new $this->model();
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
    
    protected function manager($manager)
    {
        if (file_exists(MANAGER . $manager . "Manager.php"))
        {
            require_once(MANAGER . $manager . "Manager.php");
            $this->manager = $manager . "Manager";
            
            return new $this->manager();
        }
        else
            echo("this manager doesn't exist");
    }

}