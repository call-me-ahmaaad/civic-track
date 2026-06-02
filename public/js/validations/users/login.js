const form = document.getElementById("login-form");

const username = document.getElementById("username");
const usernameStatus = document.getElementById("username-status");
const password = document.getElementById("password");
const passwordStatus = document.getElementById("password-status");

username.addEventListener('input', () => {
    usernameStatus.textContent = '';
})

password.addEventListener('input', () => {
    passwordStatus.textContent = '';
})

form.addEventListener('submit', function (e) {
    e.preventDefault();

    let isValid = true;

    if (username.value === '') {
        usernameStatus.textContent = 'Username cannot be empty';
        isValid = false;
    }

    if (password.value === '') {
        passwordStatus.textContent = 'Password cannot be empty';
        isValid = false;
    }

    if (isValid) {
        form.submit();
    }
});