<?php include VIEW . 'header.inc.php'; ?>

<h1>Reset your password</h1>

<form action="<?= URL . 'user/updatePassword' ?>" method="POST" class="col s12">
    <div class="row">
        <div class="input-field col s12"><input type="password" placeholder="Enter your new password" name="password" class="validate">
        <?php
            echo isset($data['validationError']) ? $data['validationError'] : "";
            echo isset($data['success']) ? $data['success'] : "";
        ?>
            <label for="password">Password</label>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <input type="submit" class="btn red lighten-2" name="updatePassword" value="update password">
        </div>
    </div>
</form>

<?php include VIEW . 'footer.inc.php'; ?>