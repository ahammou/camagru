<?php
ob_start();

$title = 'Camagru - Home';
?>
<div class="posts">
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