<?php

class HomeController extends Controller
{
    public function index($username = '', $email = '')
    {
        $user = $this->model('User');
        $user->setUsername($username);
        $user->setEmail($email);
        
        $userManager = $this->manager('User');
        // $users = $userManager->findAll();
        // $userManager->find(1);
        // $userManager->findByUsername('jaja');
        $userManager->exists(2);

        $this->view('home/index', [
            'user' => $user    
        ]);
    }

    public function gallery()
    {
        $this->view('home/gallery');
    }
    
    public function signin()
    {
        $this->view('home/signin');
    }

    public function register()
    {
        $this->view('home/register');
    }

    public function forgotten()
    {
        $this->view('home/forgotten');
    }
}
