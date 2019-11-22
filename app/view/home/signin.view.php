<?php include VIEW . 'header.inc.php'; ?>

<h1>login page</h1>
<?= isset($data["accountError"]) ? $data["accountError"] : ""; ?>
<div class="row">
    <form action="<?= URL . 'user/login' ?>" method="POST" class="col s12">
        <div class="row">
            <div class="input-field col s12"><input type="text" placeholder="Username" name="username" class="validate">
            <?= isset($data["error"]) ? $data["error"] : ""; ?>
                <label for="login">Login</label>
            </div>

        </div>
        <div class="row">
            <div class="input-field col s12"><input type="password" placeholder="Password" name="password" class="validate">
            <?= isset($data["error"]) ? $data["error"] : ""; ?>
                <label for="password">Password</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <input type="submit" class="btn red lighten-2" name="login" value="log in">
                <a href="<?= URL; ?>home/forgotten">forgotten password?</a>
            </div>
        </div>
    </form>
</div>

<?php include VIEW . 'footer.inc.php'; ?>