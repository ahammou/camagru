<div id="login" class="modal">
    <form class="modal-content animate" name="login" action="index.php?page=home&action=login" method="post">
        <span class="close" title="Close" onclick="closeLoginForm()">&times;</span>
        <div class="imgcontainer">
            <img class="avatar" src="public/images/avatars/male.png" width="200px" alt="avatar">
        </div>
        <div class="container">
            <label for="login"><b>Email or username</b></label>
            <input type="text" placeholder="Enter Email or Username" name="login" required>

            <label for="pass"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pass" required>

            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>

            <button class="mainbtn right bold" type="submit">Log in</button>
        </div>
        <div class="container">
            <button type="button" class="bold" onclick="closeLoginForm()">
                Cancel
            </button>
            <p id="forgotlink" class="right">
                <a href="index.php?page=forgotpsw">Forgot password?</a>
            </p>
            <p id="createAcc" class="right">Don't have an account? 
                <span id="create1" class="bold" onclick="closeLoginForm(); showSignupForm();">
                    Create one!
                </span>
            <p>
        </div>
    </form>
</div>