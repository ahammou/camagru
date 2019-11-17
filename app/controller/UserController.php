<?php

class UserController extends Controller 
{
    public function register($username = "", $email = "", $password = "")
    {
        if (RequestMethod::post("register"))
        {
            $error = [];

            $user = $this->model('User');
            $user->setUsername(RequestMethod::post("username"));
            $user->setEmail(RequestMethod::post("email"));
            $user->setConfRegKey(hash('md5', RequestMethod::post("email")));
            $user->setPassword(hash('md5', RequestMethod::post("password")));

            $manager = $this->manager('User');
            $data = $manager->findAll();
            $errors = $user->validate($data, $error);

            //var_dump($errors);
            
            $this->view("home/register", [
                "emailError" => $errors["email"],
                "usernameError" => $errors["username"]
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
