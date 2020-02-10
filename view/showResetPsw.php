<?php
ob_start();

$title = 'Camagru - Reset password';
?>
<div class="forgotpsw">
    <form name="resetpsw" action="index.php?page=forgotpsw&action=reset"
        onsubmit="return validateReset()" method="post">
        <div class="container">
            <h1>Reset password</h1>

            <input type="hidden" name="email" value="<?= $email ?>">

            <label for="pass"><b>New Password</b></label>
            <input type="password" placeholder="Enter New Password" name="pass" required>
            <span id="pass" class="span"></span>

            <label for="pass-rpt"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="pass-rpt" required>
            <span id="pass-rpt" class="span"></span>

            <button type="submit" class="mainbtn right">Send</button>
        </div>
        <div class="container">
            <a class="button" href="index.php?page=home">Cancel</a>
        </div>
    </form>
</div>
<?php
$body = ob_get_clean();

require('view/template.php');
?>