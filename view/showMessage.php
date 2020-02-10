<?php
ob_start();

$title = 'Camagru - Status';
?>
<div id="messagecontainer">
    <div class="message">
        <p><?= $msg ?></p>
    </div>
<?php if ($_SESSION['page'] !== "verify") { ?>
        <button class="bold" onclick="window.history.back()">
            Back
        </button>
<?php } ?>
    <a class="button bold" href="index.php?page=home">Home</a>
</div>
<?php
$_SESSION['page'] = "message";
$body = ob_get_clean();

require('view/template.php');
?>