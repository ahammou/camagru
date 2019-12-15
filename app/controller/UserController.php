<?php
// session_destroy();

class UserController extends Controller 
{
    
    /**
     * ================================================= METHODS USING POST REQUESTS ==========
     */
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
                    $errors["email"] = "email already associated with an account";
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

    public function login()
    {
        if (RequestMethod::post('login'))
        {
            $user = $this->model('User');
            $user->setUsername(RequestMethod::post('username'));
            $user->setPassword(RequestMethod::post("password"));

            $userManager = $this->manager('User');

            if ($userManager->findByUsername($user->getUsername()) != NULL)
            {
                $credentials =  $userManager->findByUsername($user->getUsername());
                if (password_verify($user->getPassword(), $credentials->getPassword()))
                {
                   $_SESSION['active'] = $credentials->getRegComplete();
                    if ($_SESSION['active'] != 1)
                        $this->view("home/signin", ["accountError" => "you haven't confirmed your account yet! Please check your inbox."]);
                    else
                    {
                        $_SESSION['connected'] = true;
                        $_SESSION['username'] = $credentials->getUsername();
                        $_SESSION['email'] = $credentials->getEmail();

                        $this->view("home/index", $_SESSION);
                    }
                }
                else
                    $this->view("home/signin", ["PasswordError" => "password doesn't match."]);
            }
            else
                $this->view("home/signin", ["UsernameError" => "Username does'nt exist."]);
        }
    }


    /**
     * ============================================= PASSWORD METHODS ================================================= *
     */
    public function forgotPassword()
    {
        if (RequestMethod::post('sendRecoveryMail'))
        {
            $userManager = $this->manager('User');
            $user = $userManager->findByEmail(RequestMethod::post('email'));
            if ($user)
            {
                $ip = URL . "user/recoverPassword/" . $user->getUsername() . "/" . password_hash($user->getEmail(), PASSWORD_DEFAULT);
                $url = "<a href='http://localhost:8080$ip'>recover your password</a>";
                $user->sendRecoveryEmail($user->getEmail(), $user->getUsername(), $url);
                $this->view("home/forgotten", ["success" => "mail send, check your mail box to reinitialize your password."]);

            }
            else
                $this->view('home/forgotten', ["emailError" => "the email doesn't exist"]);
        }
    }

    public function updatePassword()
    {
        if (RequestMethod::post('updatePassword'))
        {
            $error;
            $userManager = $this->manager('User');

            if (isset($_SESSION['username']))
            {
                $user = $userManager->findByUsername($_SESSION['username']);
                $user->setPassword(RequestMethod::post('password'));
                $error = $user->checkPassword(RequestMethod::post('password'));

                if (!$error)
                {
                    $userManager->updatePassword($_SESSION['username'], RequestMethod::post('password'));
                    $this->view("user/passwordRecover", ["success" => "your password was successfully updated, you can now log in"]);
                }
                else
                    $this->view("user/passwordRecover", ['validationError' => $error]);
                unset($_SESSION['username']);
            }
            else
                $this->view("user/passwordRecover", ['validationError' => 'session invalide, you should retry via the recovery link']);
        }
    }

    public function recoverPassword($username = "", $email = "")
    {
        $userManager = $this->manager('User');
        $user = $userManager->findByUsername($username);
        $_SESSION['username'] = $user->getUsername();

        if (password_verify($user->getEmail(), $email))
        {
            $this->view("user/passwordRecover");
        }
        // else 404 error
    }

    /**
     * ================================================ ACCOUNT METHODS =========================================== *
     */
    public function activateAccount($username = "", $confRegKey = "")
    {
        $userManager = $this->manager('User');
        $user = $userManager->findByUsername($username);

        if ($user->getConfRegKey() == $confRegKey)
        {
            $active = $userManager->activate($user->getUsername(), 1);
            if ($active)
            {
                $this->view("home/signin", [
                    "activated" => "account activated. you can now log in"
                ]);
            }
            else
            {
                echo "a problem occured while trying to activate your account";
            }
        }
    }

    public function updateAccount()
    {
        if (RequestMethod::post('updateAccount'))
        {
            $errors = [];
            $count = 0;

            $userManager = $this->manager('User');
            $dbUser = $userManager->findByUsername($_SESSION['username']);

            $user = $this->model('User');
            $user->setUsername(RequestMethod::post('username'));
            $user->setEmail(RequestMethod::post('email'));
            $user->setPassword(RequestMethod::post('password'));

            $errors = $user->validate();
            $user->setPassword(password_hash(RequestMethod::post('password'), PASSWORD_DEFAULT));

            $user = $userManager->update($user);
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['email'] = $user->getEmail();

            foreach ($errors as $k => $v)
            {
                if ($v)
                    $count++;
            }

            if ($count != 0)
            {
                $this->view("user/index", $errors);
            }
            else
                $this->view("user/index", ["updated" => "your account has been updated."]);            
        }
    }

    /**
     * ====================================================== SHOWING VIEWS METHODS ================================ *
     */

    public function index()
    {
        $this->view('user/index');
    }
    public function selfie()
    {
        $this->view('user/selfie');
    }
    public function logout()
    {
        session_destroy();
        header("location: " . URL . "login");
    }
}

