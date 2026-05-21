<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/login.css">

    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">
</head>

<body>
    <div class="login">
        <img class="login__logo" src="/img/civictrack_logo.svg" alt="CivicTrack">

        <form class="login__form" action="/login" method="post" novalidate autocomplete="off">
            <div class="form-input form-input--username">
                <label class="form-input__label" for="username">Username</label>
                <input class="form-input__input" type="text" name="username" id="username" required>
            </div>

            <div class="form-input form-input--password">
                <label class="form-input__label" for="password">Password</label>
                <input class="form-input__input" type="password" name="password" id="password" required>
            </div>

            <button class="form-button form-button--submit" type="submit">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php require __DIR__ . '/../../views/alerts/login.php'; ?>
</body>

</html>