<?php
define('HASH', "hashkey");

function url_encode($string) {
    return urlencode(openssl_encrypt($string, "AES-128-ECB", HASH));
}

function url_decode($string) {
    $string = urldecode($string);
    return openssl_decrypt(str_replace(' ', '+', $string), "AES-128-ECB", HASH);
}

function checkError($error) {
    if ($error != 1) {
        $error = url_encode($error);

        Header('Location: index.php?page=message&msg=' . $error);
    }
}

function setSession($user) {
    $mail = $_SESSION['mail'];
    $path = $_SESSION['path'];
    if ($_SESSION['page'])
        $page = $_SESSION['page'];

    $_SESSION = ['auth' => TRUE, 'id_user' => $user['id_user'],
                'fname' => $user['fname'], 'lname' => $user['lname'],
                'email' => $user['email'], 'login' => $user['login'],
                'notif' => $user['e_notif'], 'page' => $page,
                'mail' => $mail, 'path' => $path];
}