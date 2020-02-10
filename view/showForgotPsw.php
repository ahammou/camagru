<?php
ob_start();

$title = 'Camagru - Forgot password';
?>
<div class="forgotpsw">
    <form name="forgotpsw" method="post" onsubmit="return emailValid()"
        action="index.php?page=forgotpsw&action=request">
        <div class="container">
            <h1>Request a new password</h1>
            
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required>
            <span id="email" class="span"></span>

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