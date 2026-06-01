<?php /** @var App\Models\Resident $resident */ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Resident Detail — CivicTrack</title>
    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/pages/residents/detail.css">
    <link rel="stylesheet" href="/css/components/form-field.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="layout">
        <?php require __DIR__ . '/../../views/components/sidebar.php'; ?>

        <main class="content">
            <div class="detail">
                <h1 class="detail__title">Resident Information</h1>
                <div class="detail__data">
                    <div class="form-field form-field--identity-number" readonly>
                        <label class="form-field__label">Identity Number</label>
                        <input class="form-field__value" value="<?= $resident->getIdentityNumber() ?>" readonly>
                    </div>
                    <div class="form-field form-field--family-card-number">
                        <label class="form-field__label">Family Number</label>
                        <input class="form-field__value" value="<?= $resident->getFamilyCardNumber() ?>" readonly>
                    </div>
                    <div class="form-field form-field--fullname">
                        <label class="form-field__label">Fullname</label>
                        <input class="form-field__value" value="<?= $resident->getFullname() ?>" readonly>
                    </div>
                    <div class="form-field form-field--gender">
                        <label class="form-field__label">Gender</label>
                        <input class="form-field__value" value="<?= $resident->getGender() ?>" readonly>
                    </div>
                    <div class="form-field form-field--birthplace">
                        <label class="form-field__label">Birthplace</label>
                        <input class="form-field__value" value="<?= $resident->getBirthplace() ?>" readonly>
                    </div>
                    <div class="form-field form-field--birthdate">
                        <label class="form-field__label">Birthdate</label>
                        <input class="form-field__value" value="<?= $resident->getBirthdate() ?>" readonly>
                    </div>
                    <div class="form-field form-field--religion">
                        <label class="form-field__label">Religion</label>
                        <input class="form-field__value" value="<?= $resident->getReligion() ?>" readonly>
                    </div>
                    <div class="form-field form-field--education">
                        <label class="form-field__label">Education Level</label>
                        <input class="form-field__value" value="<?= $resident->getEducation() ?>" readonly>
                    </div>
                    <div class="form-field form-field--occupation">
                        <label class="form-field__label">Occupation</label>
                        <input class="form-field__value" value="<?= $resident->getOccupation() ?>" readonly>
                    </div>
                    <div class="form-field form-field--family-role">
                        <label class="form-field__label">Family Role</label>
                        <input class="form-field__value" value="<?= $resident->getFamilyRole() ?>" readonly>
                    </div>
                    <div class="form-field form-field--marital-status">
                        <label class="form-field__label">Marital Status</label>
                        <input class="form-field__value" value="<?= $resident->getMaritalStatus() ?>" readonly>
                    </div>
                    <div class="form-field form-field--created-at">
                        <label class="form-field__label">Created At</label>
                        <input class="form-field__value" value="<?= $resident->getCreatedAt() ?>" readonly>
                    </div>
                    <div class="form-field form-field--updated-at">
                        <label class="form-field__label">Updated at</label>
                        <input class="form-field__value" value="<?= $resident->getUpdatedAt() ?>" readonly>
                    </div>
                </div>
                <div class="form__buttons">
                    <a href="/residents/edit?id=<?= $resident->getId() ?>"
                        class="form__button form__button--edit">Edit</a>
                    <form id="deleteForm" action="/residents/destroy" method="post">
                        <input type="hidden" name="id" value="<?= $resident->getId() ?>">
                        <button type="submit" class="form__button form__button--delete" id="delete-btn">Delete</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <?php require __DIR__ . '/../components/alert.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/validations/residents/delete.js"></script>
    <script src="/js/alert.js"></script>
</body>

</html>