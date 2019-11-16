<?php

class RequestMethod
{
    public static function get($key, $default = "")
    {
        if (!empty($_GET[$key]))
            return $_GET[$key];
        return $default;
    }

    public static function post($key, $default = "")
    {
        if (!empty($_POST[$key]))
            return $_POST[$key];
        return $default;
    }

    public static function server($key, $default = "")
    {
        if (!empty($_SERVER[$key]))
            return $_SERVER[$key];
        return $default;
    }
}