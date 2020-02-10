<?php

$like = new Like;
$comments = new Comment;
foreach ($posts as $p) {
    $delId = "del" . $p['id_post'];
    $cmtId = "cmt" . $p['id_post'];
    $likes = $like->getTotalLikes($p['id_post']);
?>
    <div class="post">
        <div class="user">
            <img class="userthumb pdngleft" src="public/images/avatars/male.png">
            <span class="username"><?= htmlspecialchars($p['user']) ?></span>
<?php
    if ($p['user'] === $_SESSION['login']) {
?>
            <a href="index.php?page=post&action=delete&id=<?= $p['id_post']?>"
                style="text-decoration:none;">
                <img id="<?= $delId ?>" class="delete" src="public/images/icons/delete.png"
                    onmouseover="openBin('<?= $delId ?>')"
                    onmouseout="closeBin('<?= $delId ?>')">
            </a>
<?php
    }
?>
        </div>
        <div>
            <img class="photo" src="<?= $p['photo'] ?>" alt="Post">
        </div>
        <div class="pdngleft">
<?php
        if ($_SESSION['auth']) {
            if ($like->didUserLiked($p['id_post'], $_SESSION['login'])) {
?>
                <a href="index.php?page=like&action=unlike&id=<?= $p['id_post']?>&user=<?= $_SESSION['login']?>"
                    style="text-decoration:none;">
                    <img class="icons" src="public/images/icons/liked.png">
                </a>
<?php
            } else {
?>
                <a href="index.php?page=like&action=like&id=<?= $p['id_post']?>&user=<?= $_SESSION['login']?>"
                    style="text-decoration:none;">
                    <img class="icons" src="public/images/icons/like.png">
                </a>
<?php
            }
?>
            <img class="icons" src="public/images/icons/comment.png"
                onclick="focusInput('<?= $cmtId ?>')">
<?php
        } else {
?>
            <img class="icons" src="public/images/icons/like.png"
                onclick="showLoginForm()">
            <img class="icons" src="public/images/icons/comment.png"
                onclick="showLoginForm()">
<?php
        }
?>
            <img class="share" src="public/images/icons/share.png">
        </div>
<?php   if ($likes) { ?>
            <div class="likes">
                <span class="bold"><?= $likes ?> people liked this</span>
            </div>
<?php   } ?>
        <div class="comments pdngleft">
<?php
    $cmt = $comments->getComments($p['id_post']);
    
    foreach ($cmt as $c) {
?>
            <img class="lilthumb" src="public/images/avatars/male.png" width="10px">
            <span><b><?= htmlspecialchars($c['user']) ?></b></span>
            <span class="comment"><?= htmlspecialchars($c['comment']) ?></span>
            <br />
<?php
    }
?>
        </div>
<?php
        if ($_SESSION['auth']) {
?>
            <div>
                <form action="index.php?page=comment&action=add"
                    name="comment" method="post">
                    <input type="hidden" name="id_post" value="<?= $p['id_post'] ?>">
                    <input type="hidden" name="owner" value="<?= $p['user'] ?>">
                    <input type="hidden" name="user" value="<?= $_SESSION['login'] ?>">
                    <input type="text" id="<?= $cmtId ?>" class="addcomment" placeholder="Add a comment..." name="comment">
                </form>
            </div>
<?php
    }
?>
    </div>
    <script>
        function openBin(id) {
            var bin = document.getElementById(id);

            bin.src = "public/images/icons/delete1.png";
        }

        function closeBin(id) {
            var bin = document.getElementById(id);
            
            bin.src = "public/images/icons/delete.png";
        }

        function focusInput(id) {
            document.getElementById(id).focus();
        }
    </script>
<?php
}
?>