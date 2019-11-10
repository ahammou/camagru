<?php

if ($_SERVER['REQUEST_URI'] == '/camagru/public/')
    header('location: /camagru/public/home/');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/camagru/public/css/materialize.min.css">
    <title>Document</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="<?= URL; ?>index">Home</a></li>
        <li><a href="<?= URL; ?>gallery">Gallery</a></li>
        <li><a href="<?= URL; ?>login">Log in</a></li>
        <li><a href="<?= URL; ?>register">Register</a></li>
    </ul>
</nav>