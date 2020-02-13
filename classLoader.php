<?php
spl_autoload_register('loadClass');

function loadClass($class) {
    $path = $_SESSION['path'] . "model/";
    $ext = ".class.php";
    $filename = $path . $class . $ext;

    if (!file_exists($filename))
        return FALSE;
    
    require_once($filename);
}