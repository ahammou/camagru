<?php

function notif($val) {
    if ($val === "on")
        return 1;
    return 0;
}

function editProfile($p) {
    $user = new User;
    if ($p['email'] !== $_SESSION['email'])
        $email = $user->emailExists($p['email']);
    if ($p['login'] !== $_SESSION['login'])
        $login = $user->usernameExists($p['login']);

    if ($p['fname'] !== $_SESSION['fname'])
        $user->editFirstName($_SESSION['id_user'], $p['fname']);
    if ($p['lname'] !== $_SESSION['lname'])
        $user->editLastName($_SESSION['id_user'], $p['lname']);
    if (!$email)
        $user->editEmail($_SESSION['id_user'], $p['email']);
    if (!$login)
        $user->editUsername($_SESSION['id_user'], $p['login']);
    if ($p['pass'] !== "")
        $user->editPassword($_SESSION['id_user'], $p['pass']);
    $notif = notif($p['notif']);
    if ($notif != $_SESSION['notif'])
        $user->editNotifications($_SESSION['id_user'], $notif);

    if (!$login)
        $user = $user->getByUsername($p['login']);
    else
        $user = $user->getByUsername($_SESSION['login']);
    setSession($user);

    if ($email || $login) {
        if ($email && !$login)
            $error = "Couldn't set email. Email is";
        else if ($login && !$email)
            $error = "Couldn't set username. Username is";
        else
            $error = "Couldn't set email and username. Email and username are";
        return $error . " already used.";
    }

    Header('Location: index.php?page=profile');
}