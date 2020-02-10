<div id="signup" class="modal">
    <form class="modal-content" name="form" action="index.php?page=home&action=signup"
        onsubmit="return isFormValid(true)" method="post">
        <span class="close" title="Close" onclick="closeSignupForm()">&times;</span>
        <div class="container">
            <h1>Sign up</h1>
            <p>Please fill free to fill this form to create an account.</p>
            <p class="disclaimer">* Fields in bold are required!</p>
            <hr>
            <label for="fname">First Name</label>
            <input type="text" placeholder="Enter First Name" name="fname">
            <span id="fname" class="span"></span>

            <label for="lname">Last Name</label>
            <input type="text" placeholder="Enter Last Name" name="lname">
            <span id="lname" class="span"></span>

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required>
            <span id="email" class="span"></span>

            <label for="login"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="login" required>
            <span id="username" class="span"></span>

            <label for="pass"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pass" required>
            <span id="pass" class="span"></span>

            <label for="pass-rpt"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="pass-rpt" required>
            <span id="pass-rpt" class="span"></span>

            <div class="clearfix">
                <button type="button" class="bold" onclick="closeSignupForm()">
                    Cancel
                </button>
                <button class="mainbtn right bold" type="submit">Sign up</button>
            </div>
        </div>
    </form>
</div>