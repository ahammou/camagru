<?php include VIEW . 'header.inc.php';?>

<h1>registration page</h1>
<?php echo isset($data['success']) ? $data['success'] : '' ; ?>

<form action="<?= URL . 'user/register' ?>" method="post" class="col s12">
    <div class="row">
        <div class="input-field col s12">
            <input type="text" placeholder="Username" id="login" name="username" class="validate">
            <?= $data['usernameError'] ?>
            <label for="login">Login</label>
        </div>

    </div>
    <div class="row">
        <div class="input-field col s12">
            <input type="email" placeholder="Email" id="Email" name="email" class="validate">
            <?= isset($data['emailError']) ? $data['emailError'] : '' ?>
            <label for="email">Email</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input type="password" placeholder="Password" id="password" name="password" class="validate">
            <?= isset($data['error'], $data['errorMsg']) ? $data['errorMsg'] : '' ?>
            <label for="password">Password</label>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <input type="submit" name="register" value="register">
            <!-- <a href=<?= URL . "user/register"?> class="btn waves-effect waves-light red lighten-2" name="Register">Register</a> -->
        </div>
    </div>
</form>

<?php include VIEW . 'footer.inc.php'; ?>