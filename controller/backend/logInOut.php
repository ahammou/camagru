<?php

function login($p) {
    $user = new User;

    $email = $user->emailExists($p['login']);
    $login = $user->usernameExists($p['login']);
    if (!$email && !$login)
        return "Incorrect email/username!";
    if ($login === FALSE)
        $user = $user->getByEmail($p['login']);
    else
        $user = $user->getByUsername($p['login']);
    
    if (!password_verify($p['pass'], $user['pass']))
        return "Wrong password!";
    else if ($user['active'] != 1)
        return "You haven't confirmed your account yet! Please check your inbox.";

    setSession($user);
    return 1;
}

function logout() {
    unset($_SESSION);
    session_destroy();
    $_SESSION['database'] = TRUE;

    Header('Location: .');
}