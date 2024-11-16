function changeView() {
    var signup = document.getElementById("signIn");
    var signIn = document.getElementById("signUp");

    signup.classList.toggle("d-none");
    signIn.classList.toggle("d-none");
}

// signUp
function signUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var gender = document.getElementById("gender");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("g", gender.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            // alert(response);
            if (response == "success") {
                document.getElementById("msg").innerHTML = "Registration SuccessFull";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgDiv").className = "d-block";
            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgDiv").className = "d-block";
            }
        }
    };

    request.open("POST", "signupProcess/signupProcess.php", true);
    request.send(form);
}

// signIn
function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("r", rememberMe.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            // alert(response);

            if (response == "success") {
                window.location = "home/home.php";
            } else {
                document.getElementById("msg2").innerHTML = response;
                document.getElementById("msgDiv2").className = "d-block";
            }
        }
    }
    request.open("POST", "signupProcess/signinProcess.php", true);
    request.send(form);
}

// Forgot Password
var ForgotPasswordModal;

function forgotPassword() {
    var email = document.getElementById("email2");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var text = request.responseText;

            // alert(text);
            if (text == "Success") {
                alert("Verification code has sent successfully. Please check your Email.");
                var login = document.getElementById("signIn");
                var FPassword = document.getElementById("FPassword");

                login.classList.toggle("d-none");
                FPassword.classList.toggle("d-none");
            } else {
                document.getElementById("msg2").innerHTML = text;
                document.getElementById("msgDiv2").className = "d-block"
            }
        }
    }

    request.open("GET", "signupProcess/ForgotPassword.php?e=" + email.value, true);
    request.send();
}

// reset Password
function resetPassword() {
    var email = document.getElementById("email2");
    var NewPassword = document.getElementById("np");
    var REPassword = document.getElementById("rnp");
    var Verification = document.getElementById("VCode");

    var form = new FormData();
    form.append("e", email.value);
    form.append("n", NewPassword.value);
    form.append("r", REPassword.value);
    form.append("v", Verification.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            // alert(response);
            if (response == "Success") {
                var login = document.getElementById("signIn");
                var FPassword = document.getElementById("FPassword");

                FPassword.classList.toggle("d-none");
                login.classList.toggle("d-none");
                alert("Password updated successfully.")
            } else {
                document.getElementById("msg3").innerHTML = text;
                document.getElementById("msgDiv3").className = "d-block"
            }
        }
    }

    request.open("POST", "signupProcess/ResetPasswordProcess.php", true);
    request.send(form);
}