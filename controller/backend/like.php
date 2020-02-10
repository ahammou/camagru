<?php

function like($p) {
    $like = new Like;
    $like->addLike($p);

    Header('Location: index.php?page=' . $_SESSION['page']);
}

function unlike($id, $user) {
    $like = new Like;
    $like->rmLike($id, $user);

    Header('Location: index.php?page=' . $_SESSION['page']);
}