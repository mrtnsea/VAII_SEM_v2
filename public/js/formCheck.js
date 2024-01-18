function validateLogin() {
    let login = document.getElementById("login").value;
    let password = document.getElementById('password').value;
    let loginError = document.getElementById("loginError");
    let passwordError = document.getElementById("passwordError");

    loginError.innerHTML= "";
    passwordError.innerHTML = "";

    if (login.trim().length === 0) {
        loginError.innerHTML = "Login is required!"
    }

    if (password.trim().length ===  0) {
        passwordError.innerHTML = "Password is required!"
    }

    return (loginError.innerHTML === "" && passwordError.innerHTML === "")
}

function validateRegister() {
    let login = document.getElementById("login").value;
    let password = document.getElementById('password').value;
    let passwordRep = document.getElementById('passwordRep').value;
    let loginError = document.getElementById("loginError");
    let passwordError = document.getElementById("passwordError");
    let passwordRepError = document.getElementById("passwordRepError");

    loginError.innerHTML= "";
    passwordError.innerHTML = "";
    passwordRepError.innerHTML = "";

    let is_valid = true;

    if (!(/\d/.test(password))) {
        passwordError.innerHTML = "Must contain numbers!";
        is_valid = false;
    }

    if (!(/[^0-9]/.test(password))) {
        passwordError.innerHTML = "Must contain characters!";
        is_valid = false;
    }

    if (password < 8) {
        passwordError.innerHTML = "Must be at least 8 characters!";
        is_valid = false;
    }

    if (password !== passwordRep) {
        passwordRepError.innerHTML = "Must match password!"
        is_valid = false;
    }

    if ((/\s/).test(login)) {
        loginError.innerHTML = "Can't contain empty characters!";
        is_valid = false;
    }

    if ((/\s/).test(password)) {
        passwordError.innerHTML = "Can't contain empty characters!";
        is_valid = false;
    }

    if ((/\s/).test(passwordRep)) {
        passwordRepError.innerHTML = "Can't contain empty characters!";
        is_valid = false;
    }

    if (login.trim().length === 0) {
        loginError.innerHTML = "These field is required!";
        is_valid = false;
    }

    if (password.trim().length === 0) {
        passwordError.innerHTML = "These field is required!"
        is_valid = false;
    }

    if (passwordRep.trim().length === 0) {
        passwordRepError.innerHTML = "These field is required!"
        is_valid = false;
    }

    return is_valid;
}

function assignLoginCheck() {
    let loginForm = document.getElementById("loginForm");

    if (loginForm !== null) {
        loginForm.addEventListener("submit", function(event) {
            if (!validateLogin()) {
                event.preventDefault();
            }
        });
    }
}

function assignRegisterCheck() {
    let registerForm = document.getElementById("registerForm");

    if (registerForm !== null) {
        registerForm.addEventListener("submit", function(event) {
            if (!validateRegister()) {
                event.preventDefault();
            }
        });
    }
}

window.addEventListener('DOMContentLoaded', assignRegisterCheck);
window.addEventListener('DOMContentLoaded', assignLoginCheck);