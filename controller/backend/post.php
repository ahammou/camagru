<?php

function deletePost($id) {
    $post = new Post;
    $post->rmPost($id);

    Header('Location: index.php?page=' . $_SESSION['page']);
}