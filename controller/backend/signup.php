<?php

function confirmationMail($p) {
    $name = $p['login'];
    if ($p['fname'] !== NULL)
        $name = $p['fname'];
    $hash  = url_encode($p['email']);

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: <noreply@camagru.19>' . "\r\n";
    $subject = 'Camagru - Signup confirmation';
    $to      = $p['email'];
    $message = '
        <html>
            <head>
            </head>
            <body>
                Hi ' . $name . ',<br />
                <br />
                Thanks for signing up!<br />
                <br />
                Your account has been created, you can now login with the following credentials after you have activated your account by pressing the url below.<br />
                <br />
                -------------------------------<br />
                Username: '.$p['login'].'<br />
                Password: '.$p['pass'].'<br />
                -------------------------------<br />
                <br />
                Please click on the following link to activate your account:<br />
                <a href="http://' . $_SESSION['mail'] . 'index.php?page=verify&check='.$hash.'">Activate account</a><br />
                <br />
                Best regards,<br />
                CamagruTeam<br />
            </body>
        </html>
    ';

    mail($to, $subject, $message, $headers);
}

function register($p) {
    if ($p['fname'] === "")
        $p['fname'] = NULL;
    if ($p['lname'] === "")
        $p['lname'] = NULL;

    $user = new User;
    $email = $user->emailExists($p['email']);
    $login = $user->usernameExists($p['login']);
    if ($email || $login) {
        if ($email && !$login)
            $error = "Email is";
        else if ($login && !$email)
            $error = "Username is";
        else
            $error = "Email and username are";
        return $error . " already used.";
    }
    $user->add($p);
    confirmationMail($p);
    $msg = "We've sent you a confirmation email where you can activate your subscription! ";
    $msg .= "Please check your inbox.";
    $msg = url_encode($msg);
    Header('Location: index.php?page=message&msg=' . $msg);

    return 1;
}

function verifySub($hash) {
    $user = new User;
    $email = url_decode($hash);
    
    if (!$user->emailExists($email))
        return "You can't confirm an email that you haven't registered first!";
    $p = array('email' => $email, 'active' => 1);
    $user->activate($p);

    $user = $user->getByEmail($email);
    setSession($user);

    return "Congratulations, you're now successfully registered!";
}