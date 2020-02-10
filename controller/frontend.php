<?php

function showHome() {
    $posts = new Post;
    $posts = $posts->getFirstPosts();
    $_SESSION['page'] = "home";

    require('view/showHome.php');
}

function showProfile() {
    $posts = new Post;
    $posts = $posts->getUserFirstPosts($_SESSION['login']);
    $_SESSION['page'] = "profile";

    require('view/showProfile.php');
}

function showCamera() {
    $posts = new Post;
    $frames = new Frame;
    $frames = $frames->getAllFrames();
    $posts = $posts->getUserFirstPosts($_SESSION['login']);
    $_SESSION['page'] = "camera";

    require('view/showCamera.php');
}

function showMessage($msg = "You are at the wrong page!") {
    require('view/showMessage.php');
}

function showForgotPsw() {
    $_SESSION['page'] = "forgotPsw";

    require('view/showForgotPsw.php');
}

function showResetPsw($hash) {
    $email = url_decode($hash);
    $_SESSION['page'] = "resetPsw";

    require('view/showResetPsw.php');
}