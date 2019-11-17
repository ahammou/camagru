<?php

class UserController extends Controller 
{
    public function register($username = "", $email = "", $password = "")
    {
        if (RequestMethod::post("register"))
        {
            $error = [];
            $success = "";

            $user = $this->model('User');
            $user->setUsername(RequestMethod::post("username"));
            $user->setEmail(RequestMethod::post("email"));
            $user->setConfRegKey(hash('md5', RequestMethod::post("email")));
            $user->setPassword(hash('md5', RequestMethod::post("password")));

            $userManager = $this->manager('User');

            $errors = $user->validate();
            var_dump($errors);
            if (count($errors) != 0)
            {
                var_dump("dans errors");
                $this->view("home/register", [
                    "errors" => $errors
                ]);
            }
            else if ($userManager->exists($user->getUsername()))
            {
                var_dump("dans else if");
                $errors["username"] = "username already taken.";
            }
            else
            {
                var_dump("dans else");
                $postUser = $userManager->create($user);
                $success = "you're successfully registered, you'll  receive email to activate your account";
            }
            
            $this->view("home/register", [
                "errors" => $errors,
                "success" => $success
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
