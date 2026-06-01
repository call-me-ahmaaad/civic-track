<?php /** @var App\Models\Family $family */ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Family Edit — CivicTrack</title>
    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/pages/families/edit.css">
    <link rel="stylesheet" href="/css/components/form-field.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="layout">
        <?php require __DIR__ . '/../../views/components/sidebar.php'; ?>

        <main class="content">
            <div class="edit">
                <h1 class="edit__title">Family Edit</h1>
                <form id="editForm" action="/families/update" method="post">
                    <div class="edit__data">
                        <input type="hidden" name="id" value="<?= $family->getId() ?>">
                        <div class="form-field form-field--family-card-number">
                            <label class="form-field__label">Family Card Number</label>
                            <input class="form-field__value" name="familyCardNumber"
                                value="<?= $family->getFamilyCardNumber() ?>" id="familyCardNumber">
                            <span class="form-field__status" id="familyCardNumber-status"></span>
                        </div>
                        <div class="form-field form-field--address">
                            <label class="form-field__label">Address</label>
                            <input class="form-field__value" name="address" value="<?= $family->getAddress() ?>"
                                id="address">
                            <span class="form-field__status" id="address-status"></span>
                        </div>
                        <div class="form-field form-field--neighborhood-unit">
                            <label class="form-field__label">Neighborhood Unit</label>
                            <input class="form-field__value" name="neighborhoodUnit"
                                value="<?= $family->getNeighborhoodUnit() ?>" id="neighborhoodUnit">
                            <span class="form-field__status" id="neighborhoodUnit-status"></span>
                        </div>
                        <div class="form-field form-field--community-unit">
                            <label class="form-field__label">Community Unit</label>
                            <input class="form-field__value" name="communityUnit"
                                value="<?= $family->getCommunityUnit() ?>" id="communityUnit">
                            <span class="form-field__status" id="communityUnit-status"></span>
                        </div>
                        <div class="form-field form-field--created-at">
                            <label class="form-field__label">Data Created at</label>
                            <input class="form-field__value" value="<?= $family->getCreatedAt() ?>" disabled>
                        </div>
                        <div class="form-field form-field--updated-at">
                            <label class="form-field__label">Data Updated at</label>
                            <input class="form-field__value" value="<?= $family->getUpdatedAt() ?>" disabled>
                        </div>
                    </div>
                    <div class="form__buttons">
                        <button type="submit" class="form__button form__button--edit" id="edit-btn">Edit</button>
                        <a class="form__button form__button--cancel"
                            href="/families/detail?id=<?= $family->getId() ?>&familyCardNumber=<?= $family->getFamilyCardNumber() ?>">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <?php require __DIR__ . '/../components/alert.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/validations/families/update.js"></script>
    <script src="/js/alert.js"></script>
</body>

</html>