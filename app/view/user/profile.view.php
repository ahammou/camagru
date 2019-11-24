<?php include VIEW . 'header.inc.php'; ?>

<h1>Profile page</h1>

<form action="<?= URL . 'user/update' ?>" method="POST" class="col s12">
    <div class="row">
        <div class="input-field col s12"><input type="text" placeholder="Username" name="username" value="<?= isset($_SESSION['user']) ? $_SESSION['user'] : ''; ?>" class="validate">
            <label for="login">Login</label>
        </div>

    </div>
    <div class="row">
        <div class="input-field col s12"><input type="email" placeholder="Email" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" class="validate">
            <label for="email">Email</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12"><input type="password" placeholder="Password" name="password"  class="validate">
            <label for="password">Password</label>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <a href=<?= URL . "user/register"?> class="btn waves-effect waves-light red lighten-2" name="update">Update account</a>
        </div>
    </div>
</form>

<?php include VIEW . 'footer.inc.php'; ?>