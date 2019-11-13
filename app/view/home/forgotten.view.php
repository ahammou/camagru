<?php include VIEW . 'header.inc.php'; ?>

<h1>Reset your password</h1>

<form action="index.php" method="POST" class="col s12">
    <div class="row">
        <div class="input-field col s12"><input type="text" placeholder="Enter your email address" id="email" class="validate">
            <label for="Email">Email</label>
        </div>
        <div class="col s12">
            <p>
                You will receive a link to reinitialize your password.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <a class="btn waves-effect waves-light red lighten-2" name="reset">Reset</a>
        </div>
    </div>
</form>

<?php include VIEW . 'footer.inc.php'; ?>