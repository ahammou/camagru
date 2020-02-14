<?php

function notifMail($p, $user) {
    $name = $p['owner'];
    if ($user['fname'] !== NULL)
        $name = $user['fname'];
    $hash  = url_encode($user['email']);

    $headers  = 'MIME-Version: 1.0';
    $headers .= 'Content-type: text/html; charset=UTF-8';
    $headers .= 'From: <noreply@camagru.19>';
    $subject = 'Camagru - Notification';
    $to      = $user['email'];
    $message = '

Hi ' . $name . ',                
You have a new comment in one of your posts from ' . $p['user'] . '.
Best regards,
CamagruTeam
    ';

    mail($to, $subject, $message, $headers);
}

function addComment($p) {
    $user = new User;
    $comment = new Comment;
    $comment->addComment($p);
    $user = $user->getByUsername($p['owner']);

    if ($user['e_notif'] == 1 && $p['user'] !== $p['owner'])
        notifMail($p, $user);

    Header('Location: index.php?page=' . $_SESSION['page']);
}