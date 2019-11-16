<?php

require_once(CORE . "RequestMethod.php");

class UserController extends Controller 
{

    public function register($username = "", $email = "", $password = "")
    {
        $error = false;
        $errorMsg = "";
        $success = "";

        if (RequestMethod::post("register"))
        {
            $user = $this->model('User');
            $user->setUsername(RequestMethod::post("username"));
            $user->setEmail(RequestMethod::post("email"));
            $user->setConfRegKey(hash('md5', RequestMethod::post("email")));
            $user->setPassword(hash('whirlpool', RequestMethod::post("password")));

            if (empty($user->getUsername()) || empty($user->getEmail()) || empty($user->getPassword()))
            {
                $errorMsg = "you should complete the field";
                $error = true;
            }
            if (!$error)
            {
                $succes = "registration complete, check your email box to activate your account";
            }
            $this->view('home/register', [
                'error' => $error,
                'errorMsg' => $errorMsg,
                'success' => $success
            ]);
            //connect to database
            // $user->databaseConnect();
            //check if the user exists
            // $user->checkIfExists($user->getEmail());
        }
        //$this->model('User');
        //$this->createUser();
        //$this->sendRegKey();
    }

    public function profile()
    {
        // $this->model('User');
        // $this->view('user/profile');
    }
    public function logout()
    {
        session_abort();
        //or session_destroy()

        header("location: " . URL . "login");
    }
}
