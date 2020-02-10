<?php
require_once('controller/backend/comment.php');

if ($_GET['action'] === "add")
    addComment($_POST);