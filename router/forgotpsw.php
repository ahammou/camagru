<?php

if ($_GET['action'] === "request") {
    require_once('controller/backend/resetPsw.php');

    requestNewPsw($_POST['email']);
} else if ($_GET['action'] === "form")
    showResetPsw($_GET['check']);
else if ($_GET['action'] === "reset") {
    require_once('controller/backend/resetPsw.php');
    
    $res = resetPsw($_POST['email'], $_POST['pass']);
    checkError($res);
} else
    showForgotPsw();