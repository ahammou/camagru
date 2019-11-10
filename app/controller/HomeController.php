<?php

class HomeController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
       require_once( VIEW . "home/index.view.php");
    }

    public function gallery()
    {
        require_once(VIEW . "home/gallery.view.php");
    }
}
