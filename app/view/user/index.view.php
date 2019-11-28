<?php include VIEW . 'header.inc.php'; ?>

<h1>Profile page</h1>

<form action="<?= URL . 'user/updateAccount' ?>" method="POST" class="col s12">
    <div class="row">
        <div class="input-field col s12"><input type="text" placeholder="Username" name="username" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" class="validate">
        <?= isset($data['username']) ? $data['username'] : "" ?>
            <label for="login">Login</label>
        </div>

    </div>
    <div class="row">
        <div class="input-field col s12"><input type="email" placeholder="Email" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" class="validate">
        <?= isset($data['email']) ? $data['email'] : "" ?>
            <label for="email">Email</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12"><input type="password" placeholder="Password" name="password"  class="validate">
        <?= isset($data['password']) ? $data['password'] : "" ?>
            <label for="password">Password</label>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <input type="submit" class="btn red lighten-2" name="updateAccount" value="update account">
        </div>
    </div>
</form>

<?php include VIEW . 'footer.inc.php'; ?>