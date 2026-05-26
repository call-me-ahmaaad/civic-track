<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Family — CivicTrack</title>
    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/pages/families/create.css">
    <link rel="stylesheet" href="/css/components/form-field.css">
</head>

<body>
    <div class="layout">
        <?php require __DIR__ . '/../../views/components/sidebar.php'; ?>

        <main class="content">
            <div class="create">
                <h1 class="create__title">Family Create</h1>
                <form id="createForm" action="/families/store" method="post">
                    <div class="create__data">
                        <div class="form-field form-field--family-card-number">
                            <label class="form-field__label">Family Card Number</label>
                            <input class="form-field__value" name="familyCardNumber">
                        </div>
                        <div class="form-field form-field--address">
                            <label class="form-field__label">Address</label>
                            <input class="form-field__value" name="address">
                        </div>
                        <div class="form-field form-field--neighborhood-unit">
                            <label class="form-field__label">Neighborhood Unit</label>
                            <input class="form-field__value" name="neighborhoodUnit">
                        </div>
                        <div class="form-field form-field--community-unit">
                            <label class="form-field__label">Community Unit</label>
                            <input class="form-field__value" name="communityUnit">
                        </div>
                    </div>
                    <div class="form__buttons">
                        <button type="submit" class="form__button form__button--submit">Create</button>
                        <a class="form__button form__button--cancel" href="/families">Cancel</a>
                    </div>
                </form>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <?php require __DIR__ . '/../components/alerts/info.php' ?>
            <?php require __DIR__ . '/../components/alerts/create.php' ?>
        </main>
    </div>
</body>

</html>