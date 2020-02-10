<?php
session_start();
require_once('tools.php');
require_once('../../classLoader.php');

function createThumb($src, $dst) {
    $image = imagecreatefromjpeg($src);
    $img_w = imagesx($image);
    $img_h = imagesy($image);

    $th_h = $img_h / 2;
    $th_w = $img_w / ($img_h / $th_h);
    $thumb = imagecreatetruecolor($th_w, $th_h);
    imagecopyresampled($thumb, $image, 0, 0, 0, 0, $th_w, $th_h, $img_w, $img_h);

    $dst = "../../" . $dst;
    imagejpeg($thumb, $dst);
}

function putFrame($filename, $frame) {
    $frame = imagecreatefrompng($frame);
    $image = imagecreatefromjpeg($filename);

    $fr_w = imagesx($frame);
    $fr_h = imagesy($frame);
    $img_w = imagesx($image);
    $img_h = imagesy($image);
    imagecopyresampled($image, $frame, 0, 0, 0, 0, $img_w, $img_h, $fr_w, $fr_h);

    imagejpeg($image, $filename);
}

$here = "../../";
$dir = "public/images/";
$path = $here . $dir;
$filename = mktime() . ".jpg";
$file = $path . $filename;
$photo = $dir . $filename;
$thumb = $dir . "thumbs/" . $filename;
$frame = $here . $_POST['frame'];

$img = $_POST['image'];
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

if (file_put_contents($file, $data)) {
    putFrame($file, $frame);
    createThumb($file, $thumb);

    $arr = ['user' => $_SESSION['login'], 'photo' => $photo, 'thumb' => $thumb];
    $post = new Post;
    $post->addPost($arr);
} else {
    $msg = "File couldn't be saved!";
    $msg = url_encode($msg);
    
    Header('Location: ../../index.php?page=message&msg=' . $msg);
}
?>