<?php

if ($_GET['action'] === "login") {
    require_once('controller/backend/logInOut.php');

    $res = login($_POST);
    checkError($res);
    if ($res === 1)
        Header('Location: .');
} else if ($_GET['action'] === "logout") {
    require_once('controller/backend/logInOut.php');

    logout();
} else if ($_GET['action'] === "signup") {
    require_once('controller/backend/signup.php');

    $error = register($_POST);
    checkError($error);
} else
    Header('Location: .');