const form = document.getElementById("login-form");

const username = document.getElementById("username");
const usernameStatus = document.getElementById("username-status");
const password = document.getElementById("password");
const passwordStatus = document.getElementById("password-status");

const loginBtn = document.getElementById("login-btn");

loginBtn.addEventListener('click', function (e) {
    e.preventDefault();

    let error = 0;

    usernameStatus.textContent = '';
    passwordStatus.textContent = '';

    if (username.value === '') {
        usernameStatus.textContent = 'Username cannot be empty';
        error++;
    }

    if (password.value === '') {
        passwordStatus.textContent = 'Password cannot be empty';
        error++;
    }

    if (error === 0) {
        form.submit();
    }
});