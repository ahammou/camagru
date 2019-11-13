<?php include VIEW . 'header.inc.php'; ?>

<h1>login page</h1>

<div class="row">
    <form action="index.php" method="POST" class="col s12">
        <div class="row">
            <div class="input-field col s12"><input type="text" placeholder="Username" id="login" class="validate">
                <label for="login">Login</label>
            </div>

        </div>
        <div class="row">
            <div class="input-field col s12"><input type="password" placeholder="Password" id="login" class="validate">
                <label for="password">Password</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <a class="btn waves-effect waves-light red lighten-2" name="log">Log in </a>
                <a href="<?= URL; ?>home/forgotten">forgotten password?</a>
            </div>
        </div>
    </form>
</div>

<?php include VIEW . 'footer.inc.php'; ?>