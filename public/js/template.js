var login  = document.getElementById('login');
var signup = document.getElementById('signup');
var profile = document.getElementById('editProfile');

function showSignupForm() {
    signup.style.display = "block";
}

function showLoginForm() {
    login.style.display = "block";
}

function showProfileForm() {
    profile.style.display = "block";
}

function closeSignupForm() {
    signup.style.display = "none";
}

function closeLoginForm() {
    login.style.display = "none";
}

function closeProfileForm() {
    profile.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == signup)
        closeSignupForm();
    else if (event.target == login)
        closeLoginForm();
    else if (event.target == profile)
        closeProfileForm();
}