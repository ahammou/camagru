<?php include VIEW . 'header.inc.php'; ?>

<h1>registration page</h1>

<form action="index.php" method="POST" class="col s12">
    <div class="row">
        <div class="input-field col s12"><input type="text" placeholder="Username" id="login" class="validate">
            <label for="login">Login</label>
        </div>

    </div>
    <div class="row">
        <div class="input-field col s12"><input type="email" placeholder="Email" id="Email" class="validate">
            <label for="email">Email</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12"><input type="password" placeholder="Password" id="password" class="validate">
            <label for="password">Password</label>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <a href=<?= URL . "user/register"?> class="btn waves-effect waves-light red lighten-2" name="Rergister">Register</a>
        </div>
    </div>
</form>

<?php include VIEW . 'footer.inc.php'; ?>