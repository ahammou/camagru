<?php

class UserController extends Controller 
{
    public function register($username = "", $email = "", $password = "")
    {
        if (RequestMethod::post("register"))
        {
            $error = [];
            $success = "";
            $count = 0;

            $user = $this->model('User');
            $user->setUsername(RequestMethod::post("username"));
            $user->setEmail(RequestMethod::post("email"));
            $user->setConfRegKey(hash('md5', RequestMethod::post("email")));
            $user->setPassword(RequestMethod::post("password"));

            $userManager = $this->manager('User');

            $errors = $user->validate();     
            foreach ($errors as $k => $v)
            {
                if ($v)
                    $count++;
            }

            $bool = $userManager->existsByUsername($user->getUsername());

            if ($count != 0)
            {
                if ($bool)
                    $errors["username"] = "username already taken.";
                $this->view("home/register", [
                    "errors" => $errors
                ]);
            }
            else
            {
                if ($bool)
                {
                    $errors["username"] = "username already taken.";
                    $this->view("home/register", [
                        "errors" => $errors
                    ]);
                }
                else
                {
                    $postUser = $userManager->create($user);
                    $success = "you're successfully registered, you'll  receive email to activate your account";
                }
            }
            
            $this->view("home/register", [
                // "errors" => $errors,
                "success" => $success
            ]);
        }
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
