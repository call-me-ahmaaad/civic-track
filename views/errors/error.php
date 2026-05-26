<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Error — CivicTrack</title>
    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/error.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="error">
        <img class="error__logo" src="/img/warning_logo.webp" alt="Error">
        <h1 class="error__title">Database Error</h1>
        <p class="error__text">Something went wrong while connecting to the database</p>
        <p class="error__message">Message: <?= $_SESSION['error'] ?></p>
        <a class="error__button" href="/logout">Logout</a>
    </div>
</body>

</html>