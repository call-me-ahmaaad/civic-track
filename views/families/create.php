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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
                            <input class="form-field__value" name="familyCardNumber" id="familyCardNumber">
                            <span class="form-field__status" id="familyCardNumber-status"></span>
                        </div>
                        <div class="form-field form-field--address">
                            <label class="form-field__label">Address</label>
                            <input class="form-field__value" name="address" id="address">
                            <span class="form-field__status" id="address-status"></span>
                        </div>
                        <div class="form-field form-field--neighborhood-unit">
                            <label class="form-field__label">Neighborhood Unit</label>
                            <input class="form-field__value" name="neighborhoodUnit" id="neighborhoodUnit">
                            <span class="form-field__status" id="neighborhoodUnit-status"></span>
                        </div>
                        <div class="form-field form-field--community-unit">
                            <label class="form-field__label">Community Unit</label>
                            <input class="form-field__value" name="communityUnit" id="communityUnit">
                            <span class="form-field__status" id="communityUnit-status"></span>
                        </div>
                    </div>
                    <div class="form__buttons">
                        <button type="submit" class="form__button form__button--create" id="create-btn">Create</button>
                        <a class="form__button form__button--cancel" href="/families">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
    
    <?php require __DIR__ . '/../components/alert.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/validations/families/create.js"></script>
    <script src="/js/alert.js"></script>
</body>

</html>