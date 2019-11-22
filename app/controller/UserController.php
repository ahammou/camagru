<?php
// session_destroy();

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
                    $ip = URL . "user/activateAccount/" . $user->getUsername() . "/" . $user->getConfRegKey();
                    $url = "<a href='http://localhost:8080$ip'>Activate your account</a>";
                    $user->sendVerificationEmail($user->getEmail(), $user->getUsername(), $url);
                }
            }
            $this->view("home/register", [
                "errors" => $errors,
                "success" => $success
            ]);
        }
    }
    
    public function activateAccount($username = "", $confRegKey = "")
    {
        $userManager = $this->manager('User');
        $user = $userManager->findByUsername($username);

        if ($user->getConfRegKey() == $confRegKey)
        {
            $active = $userManager->activate($user->getUsername(), 1);
            if ($active)
            {
                $this->view("home/login", [
                    "activated" => "account activated. you can now log in"
                ]);
            }
            else
            {
                echo "a problem occured while trying to activate your account";
            }
        }
    }

    public function login()
    {
        if (RequestMethod::post('login'))
        {
            $user = $this->model('User');
            $user->setUsername(RequestMethod::post('username'));
            $user->setPassword(RequestMethod::post("password"));

            $userManager = $this->manager('User');
            $credentials = $userManager->findByUsername($user->getUsername());

            if ($credendials)
            {
                if (password_verify($user->getPassword(), $credentials->getPassword()))
                {
                    $_SESSION['active'] = $credentials->getRegComplete();
                    if ($_SESSION['active'] == 0)
                        $this->view("home/signin", ["accountError" => "you haven't confirmed your account yet! Please check your inbox."]);
                    else
                    {
                        $_SESSION['user'] = $credentials->getUsername();
                        $_SESSION['email'] = $credentials->getEmail();
                        $this->view("user/profile");
                    }
                }
                else
                    $this->view("home/signin", ["error" => "password doesn't match."]);
            }
            else
                $this->view("home/signin", ["error" => "Username does'nt exist."]);
        }
    }

    public function profile()
    {
        // $this->model('User');
        $this->view('user/profile');
    }
    public function logout()
    {
        session_abort();
        //or session_destroy()

        header("location: " . URL . "login");
    }
}

