<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/pages/auth/login.css">

    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">
</head>

<body>
    <div class="login">
        <div class="login__banner">
            <img src="/img/civictrack_login-banner.webp" alt="CivicTrack Login Banner">
        </div>
        <div class="login__form">
            <div class="login__header">
                <img class="login__logo" src="/img/civictrack_logo.svg" alt="CivicTrack Logo">
                <p class="login__tagline">Smart Administration for Better Communities</p>
            </div>

            <form class="login__inputs" action="/login" method="post" novalidate autocomplete="off">
                <div class="form-field form-field--username">
                    <label class="form-field__label" for="username">Username</label>
                    <input class="form-field__value" type="text" name="username" id="username" required
                        placeholder="Input your username">
                </div>

                <div class="form-field form-field--password">
                    <label class="form-field__label" for="password">Password</label>
                    <input class="form-field__value" type="password" name="password" id="password" required
                        placeholder="Input your password">
                </div>

                <button class="form__button form__button--submit" type="submit">Login</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php require __DIR__ . '/../components/alerts/info.php' ?>
</body>

</html>