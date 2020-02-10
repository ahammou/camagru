function checkName(fname, lname) {
    var error;
    var regex = /^[a-zàáâäçèéêëìíîïñòóôöùúûü]{2,}(([ \-\'][a-zàáâäçèéêëìíîïñòóôöùúûü]{2,})?[a-zàáâäçèéêëìíîïñòóôöùúûü]*)*$/i;
    var first = fname.match(regex);
    var last = lname.match(regex);

    if (!first && fname != "") {
        document.getElementById('fname').innerHTML = "First name incorrect!";
        error = true;
    }
    if (!last && lname != "") {
        document.getElementById('lname').innerHTML = "Last name incorrect!";
        error = true;
    }
    if (error)
        return false;
    return true;
}

function checkEmail(email) {
    var regex = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z0-9]+$/i;
    email = email.match(regex);

    if (!email) {
        document.getElementById('email').innerHTML = "Email incorrect!";
        return false;
    }
    return true;
}

function checkUsername(login) {
    var regex = /^(?=.{5,32}$)(?!.*((\.\.)|(\-\-)|(\_\_)))(?!.*\.$)[a-z][a-z0-9\.\-\_]*$/i;
    login = login.match(regex);

    if (!login) {
        document.getElementById('username').innerHTML = "Username incorrect!";
        return false;
    }
    return true;
}

function checkPassword(pass, passRpt) {
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{12,64}$/;
    if (pass !== passRpt)
        passRpt = false;
    if (pass)
        pass = pass.match(regex);

    if (!pass)
        document.getElementById('pass').innerHTML = "Password incorrect!";
    if (!passRpt && pass)
        document.getElementById('pass-rpt').innerHTML = "Passwords don't match!";
    if (!pass || !passRpt)
        return false;
    return true;
}

function isFormValid(pswMandatory) {
    var x;
    var arrClass = document.getElementsByClassName('span');
    for (x of arrClass) {
        x.innerHTML = "";
    }

    var form = document.forms['form'];
    var name = checkName(form['fname'].value, form['lname'].value);
    var email = checkEmail(form['email'].value);
    var login = checkUsername(form['login'].value);
    if (pswMandatory)
        var pass = checkPassword(form['pass'].value, form['pass-rpt'].value);
    else {
        if (form['pass'].value || form['pass-rpt'].value)
            var pass = checkPassword(form['pass'].value, form['pass-rpt'].value);
        else
            var pass = true;
    }
        
    if (!name || !email || !login || !pass)
        return false;
    return true;
}

function validateReset() {
    var x;
    var arrClass = document.getElementsByClassName('span');
    for (x of arrClass) {
        x.innerHTML = "";
    }

    var form = document.forms['resetpsw'];
    var pass = checkPassword(form['pass'].value, form['pass-rpt'].value);
    if (!pass)
        return false;
    return true;
}

function emailValid() {
    var form = document.forms['forgotpsw'];
    var email = checkEmail(form['email'].value);
    if (!email)
        return false;
    return true;
}