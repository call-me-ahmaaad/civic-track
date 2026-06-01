<?php /** @var App\Models\Resident $resident */ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Resident Edit — CivicTrack </title>
    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/pages/residents/edit.css">
    <link rel="stylesheet" href="/css/components/form-field.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="layout">
        <?php require __DIR__ . '/../../views/components/sidebar.php'; ?>

        <main class="content">
            <div class="edit">
                <h1 class="edit__title">Resident Information</h1>
                <form id="editForm" action="/residents/update" method="post">
                    <div class="edit__data">
                        <input type="hidden" name="id" value="<?= $resident->getId() ?>">
                        <div class="form-field form-field--identity-number">
                            <label class="form-field__label">Identity Number</label>
                            <input class="form-field__value" name="identityNumber" type="text"
                                value="<?= $resident->getIdentityNumber() ?>" id="identityNumber">
                            <span class="form-field__status" id="identityNumber-status"></span>
                        </div>
                        <div class="form-field form-field--family-card-number">
                            <label class="form-field__label">Family Number</label>
                            <input class="form-field__value" name="familyCardNumber" type="text"
                                value="<?= $resident->getFamilyCardNumber() ?>" id="familyCardNumber">
                            <span class="form-field__status" id="familyCardNumber-status"></span>
                        </div>
                        <div class="form-field form-field--fullname">
                            <label class="form-field__label">Fullname</label>
                            <input class="form-field__value" name="fullname" type="text"
                                value="<?= $resident->getFullname() ?>" id="fullname">
                            <span class="form-field__status" id="fullname-status"></span>
                        </div>
                        <div class="form-field form-field--gender">
                            <label class="form-field__label">Gender</label>
                            <select class="form-field__value" name="gender">
                                <option value="Male" <?= $resident->getGender() === 'Male' ? 'selected' : '' ?>>Male
                                </option>
                                <option value="Female" <?= $resident->getGender() === 'Female' ? 'selected' : '' ?>>Female
                                </option>
                            </select>
                        </div>
                        <div class="form-field form-field--birthplace">
                            <label class="form-field__label">Birthplace</label>
                            <select class="form-field__value" name="birthplace">
                                <?php foreach ($dropdown['cities'] as $city): ?>
                                    <option value="<?= $city['id'] ?>" <?= $resident->getBirthplace() === $city['city'] ? 'selected' : '' ?>><?= $city['city'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--birthdate">
                            <label class="form-field__label">Birthdate</label>
                            <input class="form-field__value" name="birthdate" type="date"
                                value="<?= $resident->getBirthdate() ?>">
                        </div>
                        <div class="form-field form-field--religion">
                            <label class="form-field__label">Religion</label>
                            <select class="form-field__value" name="religion">
                                <?php foreach ($dropdown['religions'] as $religion): ?>
                                    <option value="<?= $religion['id'] ?>"
                                        <?= $resident->getReligion() === $religion['religion'] ? 'selected' : '' ?>>
                                        <?= $religion['religion'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--education">
                            <label class="form-field__label">Education</label>
                            <select class="form-field__value" name="education">
                                <?php foreach ($dropdown['educations'] as $education): ?>
                                    <option value="<?= $education['id'] ?>"
                                        <?= $resident->getEducation() === $education['education'] ? 'selected' : '' ?>>
                                        <?= $education['education'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--occupation">
                            <label class="form-field__label">Occupation</label>
                            <select class="form-field__value" name="occupation">
                                <?php foreach ($dropdown['occupations'] as $occupation): ?>
                                    <option value="<?= $occupation['id'] ?>"
                                        <?= $resident->getOccupation() === $occupation['occupation'] ? 'selected' : '' ?>>
                                        <?= $occupation['occupation'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--family-role">
                            <label class="form-field__label">Family Role</label>
                            <select class="form-field__value" name="familyRole">
                                <?php foreach ($dropdown['family_roles'] as $role): ?>
                                    <option value="<?= $role['id'] ?>" <?= $resident->getFamilyRole() === $role['role'] ? 'selected' : '' ?>><?= $role['role'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--marital-status">
                            <label class="form-field__label">Marital Status</label>
                            <select class="form-field__value" name="maritalStatus">
                                <option value="Single" <?= $resident->getMaritalStatus() === 'Single' ? 'selected' : '' ?>>
                                    Single</option>
                                <option value="Married" <?= $resident->getMaritalStatus() === 'Married' ? 'selected' : '' ?>>Married</option>
                                <option value="Divorced" <?= $resident->getMaritalStatus() === 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                                <option value="Widowed" <?= $resident->getMaritalStatus() === 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                            </select>
                        </div>
                        <div class="form-field form-field--created-at">
                            <label class="form-field__label">Data Created At</label>
                            <input class="form-field__value" value="<?= $resident->getCreatedAt() ?>" disabled>
                        </div>
                        <div class="form-field form-field--updated-at">
                            <label class="form-field__label">Data Updated at</label>
                            <input class="form-field__value" value="<?= $resident->getUpdatedAt() ?>" disabled>
                        </div>
                    </div>
                    <div class="form__buttons">
                        <button type="submit" class="form__button form__button--edit" id="edit-btn">Edit</button>
                        <a class="form__button form__button--cancel"
                            href="/residents/detail?id=<?= $resident->getId() ?>">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <?php require __DIR__ . '/../components/alert.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/validations/residents/update.js"></script>
    <script src="/js/alert.js"></script>
</body>

</html>