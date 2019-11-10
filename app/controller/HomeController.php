<?php

class HomeController extends Controller
{
    public function index($userName = '', $email = '')
    {
        $user = $this->model('User');
        $user->userName = $userName;
        $user->email = $email;

        $this->view('home/index', [
            'userName' => $user->userName,
            'email' => $user->email
        ]);
    }

    public function gallery()
    {
        $this->view('home/gallery');
    }
    
    public function login()
    {
        $this->view('home/login');
    }

    public function register()
    {
        $this->view('home/register');
    }

    public function forgottenPwd()
    {
        $this->view('home/forgotten');
    }
}
