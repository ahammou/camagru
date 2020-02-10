<?php
require_once('controller/backend/post.php');

if ($_GET['action'] === "delete")
    deletePost($_GET['id']);