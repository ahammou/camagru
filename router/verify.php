<?php
require_once('controller/backend/signup.php');

$_SESSION['page'] = "verify";
$res = verifySub($_GET['check']);
checkError($res);