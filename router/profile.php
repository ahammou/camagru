<?php

if (isset($_GET['action']) === "edit") {
    require_once('controller/backend/editProfile.php');

    $res = editProfile($_POST);
    if ($res)
        checkError($res);
} else
    showProfile();