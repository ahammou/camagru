<?php

class View
{
    protected $viewFile;
    protected $viewData;

    public function __construct($viewFile, $viewData)
    {
        $this->viewFile = $viewFile;
        $this->viewData = $viewData;
    }

    public function render()
    {
        if (file_exists(VIEW . $this->viewFile . '.view.php'))
        {
            include VIEW . $this->viewFile . '.view.php';
        }
    }
}