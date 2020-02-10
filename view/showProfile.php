<?php
ob_start();
include('includes/profileForm.php');

$title = 'Camagru - Profile';
?>
<div class="profile">
    <div class="imgcontainer">
        <img class="avatar" src="public/images/avatars/male.png" alt="avatar">
    </div>
    <div class="container">
        <p id="name"><?= $_SESSION['fname'] ?> <?= $_SESSION['lname'] ?></p>
        <p id="login"><?= $_SESSION['login'] ?></p>
    </div>
    <button onclick="showProfileForm()">Edit profile</button>
</div>
<div id="userPosts" class="posts">
<?php
if (!empty($posts)) {
    require_once('includes/posts.php');
?>
</div>
<script src="public/jquery/infScroll.js"></script>
<?php
    $loader = TRUE;
    $body = ob_get_clean();
} else {
    require_once('includes/npy.php');
?>
</div>
<?php
    $body = ob_get_clean();
}

require('template.php');
?>