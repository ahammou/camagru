<?php

function resetPswMail($email) {
    $user = new User;
    $user = $user->getByEmail($email);

    $name = $user['login'];
    if ($user['fname'] !== NULL)
        $name = $user['fname'];
    $hash  = url_encode($email);

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: <noreply@camagru.19>' . "\r\n";
    $subject = 'Camagru - Reset password';
    $to      = $email;
    $message = '
        <html>
            <head>
            </head>
            <body>
                Hi ' . $name . ',<br />
                <br />
                You requested a new password!<br />
                <br />
                Please click on the following link to reset your password:<br />
                <a href="http://' . $_SESSION['mail'] . 'index.php?page=forgotpsw&action=form&check='.$hash.'">Reset password</a><br />
                <br />
                Best regards,<br />
                CamagruTeam<br />
            </body>
        </html>
    ';
    
    mail($to, $subject, $message, $headers);
}

function requestNewPsw($email) {
    resetPswMail($email);
    $msg = "We've sent you an email with a link. ";
    $msg .= "You can click on that link to reset your password! ";
    $msg .= "Please check your inbox.";
    $msg = url_encode($msg);
    
    Header('Location: index.php?page=message&msg=' . $msg);
}

function resetPsw($email, $pass) {
    $u = new User;
    
    if (!$u->emailExists($email))
        return "You can't reset password for an account that doesn't exist!";

    $user = $u->getByEmail($email);
    $u->editPassword($user['id_user'], $pass);
    setSession($user);

    return "You have successfully reset your password!";
}