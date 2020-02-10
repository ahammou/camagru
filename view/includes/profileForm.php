<div id="editProfile" class="modal">
    <form class="modal-content" name="form" action="index.php?page=profile&action=edit"
        onsubmit="return isFormValid(false)" method="post">
        <span class="close" title="Close" onclick="closeProfileForm()">&times;</span>
        <div class="container">
            <h1>Edit profile</h1>
            <label for="fname">First Name</label>
            <input type="text" value="<?= $_SESSION['fname'] ?>" name="fname">
            <span id="fname" class="span"></span>

            <label for="lname">Last Name</label>
            <input type="text" value="<?= $_SESSION['lname'] ?>" name="lname">
            <span id="lname" class="span"></span>

            <label for="email"><b>Email</b></label>
            <input type="email" value="<?= $_SESSION['email'] ?>" name="email">
            <span id="email" class="span"></span>

            <label for="login"><b>Username</b></label>
            <input type="text" value="<?= $_SESSION['login'] ?>" name="login">
            <span id="username" class="span"></span>

            <label for="pass"><b>Password</b></label>
            <input type="password" name="pass">
            <span id="pass" class="span"></span>

            <label for="pass-rpt"><b>Repeat Password</b></label>
            <input type="password" name="pass-rpt">
            <span id="pass-rpt" class="span"></span>
<?php
if ($_SESSION['notif'] == 1) {
?>
            <label>
                <input type="checkbox" checked="checked" name="notif"> Notifications
            </label>
<?php
} else {
?>
            <label>
                <input type="checkbox" name="notif"> Notifications
            </label>
<?php
}
?>
            <div class="clearfix">
                <button type="button" onclick="closeProfileForm()">Cancel</button>
                <button type="submit" class="mainbtn right">Save</button>
            </div>
        </div>
    </form>
</div>
<script src="public/js/template.js"></script>