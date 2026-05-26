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
</head>

<body>
    <div class="layout">
        <?php require __DIR__ . '/../../views/components/sidebar.php'; ?>

        <main class="content">
            <div class="edit">
                <h1 class="edit__title">Family Edit</h1>
                <form id="editForm" action="/families/update" method="post">
                    <div class="edit__data">
                        <input type="hidden" name="id" value="<?= $family['id']; ?>">
                        <div class="form-field form-field--family-card-number">
                            <label class="form-field__label">Family Card Number</label>
                            <input class="form-field__value" name="familyCardNumber"
                                value="<?= $family['family_card_number']; ?>">
                        </div>
                        <div class="form-field form-field--address">
                            <label class="form-field__label">Address</label>
                            <input class="form-field__value" name="address" value="<?= $family['address']; ?>">
                        </div>
                        <div class="form-field form-field--neighborhood-unit">
                            <label class="form-field__label">Neighborhood Unit</label>
                            <input class="form-field__value" name="neighborhoodUnit"
                                value="<?= $family['neighborhood_unit']; ?>">
                        </div>
                        <div class="form-field form-field--community-unit">
                            <label class="form-field__label">Community Unit</label>
                            <input class="form-field__value" name="communityUnit"
                                value="<?= $family['community_unit']; ?>">
                        </div>
                        <div class="form-field form-field--created-at">
                            <label class="form-field__label">Data Created at</label>
                            <input class="form-field__value" value="<?= $family['created_at']; ?>" disabled>
                        </div>
                        <div class="form-field form-field--updated-at">
                            <label class="form-field__label">Data Updated at</label>
                            <input class="form-field__value" value="<?= $family['updated_at']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form__buttons">
                        <button type="submit" class="form__button form__button--submit">Edit</button>
                        <a class="form__button form__button--cancel"
                            href="/families/detail?familyCardNumber=<?= $family['family_card_number'] ?>">Cancel</a>
                    </div>
                </form>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <?php require __DIR__ . '/../components/alerts/info.php' ?>
            <?php require __DIR__ . '/../components/alerts/edit.php' ?>
</body>

</html>