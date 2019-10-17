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
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="index">Home</a></li>
        <li><a href="gallery">Gallery</a></li>
        <li><a href="login">Log in</a></li>
        <li><a href="register">Register</a></li>
    </ul>
</nav>