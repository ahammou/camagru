<?php
// phpinfo();
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
session_start();
require_once('classLoader.php');
require_once('controller/frontend.php');
require_once('controller/backend/tools.php');

try {
    switch(isset($_GET['page'])) {
        case "home":
            require_once('router/home.php');
            break;
        case "camera":
            require_once('router/camera.php');
            break;
        case "profile":
            require_once('router/profile.php');
            break;
        case "verify":
            require_once('router/verify.php');
            break;
        case "message":
            require_once('router/message.php');
            break;
        case "forgotpsw":
            require_once('router/forgotpsw.php');
            break;
        case "post":
            require_once('router/post.php');
            break;
        case "like":
            require_once('router/like.php');
            break;
        case "comment":
            require_once('router/comment.php');
            break;
        default:
            $_SESSION['mail'] = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $_SESSION['path'] = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
            require_once('router/default.php');
    }
} catch(Exception $e) {
    showMessage("Error: " . $e->getMessage());
}