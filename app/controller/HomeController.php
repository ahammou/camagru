<?php

class HomeController extends Controller
{
    public function index($id = '', $name = '')
    {
        $this->view('home/index', [
            'id' => $id,
            'name' => $name
        ]);
        $this->view->render();
    }

    public function gallery()
    {
        $this->view('home/gallery', []);
        $this->view->render();
    }

    public function register()
    {
        $this->view('home/register', []);
        $this->view->render();
    }
    public function login()
    {
        $this->view('home/login', []);
        $this->view->render();
    }
}

