<?php include VIEW . 'header.inc.php'; ?>

<h1>Reset your password</h1>

<form action="<?= URL . 'user/forgotPassword' ?>" method="POST" class="col s12">
    <div class="row">
        <div class="input-field col s12"><input type="text" placeholder="Enter your email address" name="email" class="validate">
        <?= isset($data['emailError']) ? $data['emailError'] : ""; ?>
            <label for="Email">Email</label>
        </div>
        <div class="col s12">
            <p>
                <?= isset($data['success']) ? $data['success'] : '' ?>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <input type="submit" class="btn indigo lighten-2" name="sendRecoveryMail" value="send recovery email">
        </div>
    </div>
</form>

<?php include VIEW . 'footer.inc.php'; ?>