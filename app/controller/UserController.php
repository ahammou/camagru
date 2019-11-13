<?php

class UserController extends Controller 
{
    public function __construct()
    {
        # code...
    }
    public function register()
    {
        echo "HI WELCOME TO REGISTRATION RESULT";
    }
    public function logout()
    {
        session_abort();
        //or session_destroy()

        header("location: " . URL . "login");
    }
}
