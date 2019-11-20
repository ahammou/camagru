<?php include VIEW . 'header.inc.php';?>

<h1>registration page</h1>
<?php echo isset($data['success']) ? $data['success'] : '' ; ?>

<form action="<?= URL . 'user/register' ?>" method="post" class="col s12">
    <div class="row">
        <div class="input-field col s12">
            <input type="text" placeholder="Username" id="login" name="username" class="validate">
            <?= isset($data['errors']['username']) ? $data['errors']['username'] : '' ?>
            <label for="login">Login</label>
        </div>

    </div>
    <div class="row">
        <div class="input-field col s12">
            <input type="text" placeholder="Email" id="Email" name="email" class="validate">
            <?= isset($data['errors']['email']) ? $data['errors']['email'] : "" ?>
            <label for="email">Email</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input type="password" placeholder="Password" id="password" name="password" class="validate">
            <?= isset($data['errors']['password']) ? $data['errors']['password'] : '' ?>
            <label for="password">Password</label>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <input type="submit" class="btn red lighten-2" name="register" value="register">
        </div>
    </div>
</form>

<?php include VIEW . 'footer.inc.php'; ?>