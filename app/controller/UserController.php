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
            $user->setPassword(password_hash(RequestMethod::post("password"), PASSWORD_DEFAULT));    

            foreach ($errors as $k => $v)
            {
                if ($v)
                    $count++;
            }

            $boolU = $userManager->existsByUsername($user->getUsername());
            $boolE = $userManager->existsByEmail($user->getEmail());
            if ($count != 0)
            {
                if ($boolU)
                    $errors["username"] = "username already taken.";
                if ($boolE)
                    $errors["email"] = "email already associated with an accouny";
            }
            else
            {
                if ($boolU || $boolE)
                {
                    
                    if ($boolU)
                        $errors["username"] = "username already taken.";
                    if ($boolE)
                        $errors["email"] = "email already associated with an account";
                }
                else
                {
                    $postUser = $userManager->create($user);
                    $success = "you're successfully registered, you'll  receive email to activate your account";
                //     $ip = URL . "user/activateAccount/" . $user->getUsername() . DIRECTORY_SEPARATOR . $user->getConfRegKey();
                //     $url = "<a href='http://127.0.0.1/$ip'>Activez votre compte</a>";
                //     $user->sendVerificationEmail($user->getEmail(), $user->getUsername(), $url);
                // }
                }
            
                $this->view("home/register", [
                    "errors" => $errors,
                    "success" => $success
                ]);
            }
        }
    }
    
    public function activateAccount($username, $confRegKey)
    {
        $userManager = $this->manager('User');
        $user = $userManager->findByUsername($username);

        if ($user->getConfRegKey() == $confRegKey)
        {
            $userManager->update("regComplete","1");
            echo "account activated";
        }

        print_r($user);
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

