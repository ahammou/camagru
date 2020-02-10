<?php
session_start();
require_once('../../classLoader.php');

$offset = (int)$_POST['offset'];
$recordsPerPage = 5;

$posts = new Post;
if ($_SESSION['page'] === "home") {
    $posts = $posts->getPagePosts($offset, $recordsPerPage);

    require_once('../../view/includes/posts.php');
} elseif ($_SESSION['page'] === "camera") {
    $posts = $posts->getUserPagePosts($_SESSION['login'], $offset, $recordsPerPage);

    require_once('../../view/includes/userThumbs.php');
} elseif ($_SESSION['page'] === "profile") {
    $posts = $posts->getUserPagePosts($_SESSION['login'], $offset, $recordsPerPage);

    require_once('../../view/includes/posts.php');
}