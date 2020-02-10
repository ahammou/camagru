<?php
require_once('controller/backend/like.php');

if ($_GET['action'] === "like") {
    $p = ['id_post' => $_GET['id'], 'user' => $_GET['user']];
    like($p);
} else if ($_GET['action'] === "unlike") {
    unlike($_GET['id'], $_GET['user']);
}