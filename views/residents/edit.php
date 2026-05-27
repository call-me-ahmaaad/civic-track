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
                        <input type="hidden" name="id" value="<?= $resident['id']; ?>">
                        <div class="form-field form-field--identity-number">
                            <label class="form-field__label">Identity Number</label>
                            <input class="form-field__value" name="identityNumber" type="text"
                                value="<?= $resident['identity_number']; ?>">
                        </div>
                        <div class="form-field form-field--family-card-number">
                            <label class="form-field__label">Family Number</label>
                            <input class="form-field__value" name="familyCardNumber" type="text"
                                value="<?= $resident['family_card_number']; ?>">
                        </div>
                        <div class="form-field form-field--fullname">
                            <label class="form-field__label">Fullname</label>
                            <input class="form-field__value" name="fullname" type="text"
                                value="<?= $resident['fullname']; ?>">
                        </div>
                        <div class="form-field form-field--gender">
                            <label class="form-field__label">Gender</label>
                            <select class="form-field__value" name="gender">
                                <option value="Male" <?= $resident['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?= $resident['gender'] === 'Female' ? 'selected' : ''; ?>>Female
                                </option>
                            </select>
                        </div>
                        <div class="form-field form-field--birthplace">
                            <label class="form-field__label">Birthplace</label>
                            <select class="form-field__value" name="birthplace">
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?= $city['id']; ?>" <?= $resident['birthplace'] === $city['city'] ? 'selected' : ''; ?>><?= $city['city']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--birthdate">
                            <label class="form-field__label">Birthdate</label>
                            <input class="form-field__value" name="birthdate" type="date"
                                value="<?= $resident['birthdate']; ?>">
                        </div>
                        <div class="form-field form-field--religion">
                            <label class="form-field__label">Religion</label>
                            <select class="form-field__value" name="religion">
                                <?php foreach ($religions as $religion): ?>
                                    <option value="<?= $religion['id']; ?>" <?= $resident['religion'] === $religion['religion'] ? 'selected' : ''; ?>><?= $religion['religion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--education">
                            <label class="form-field__label">Education</label>
                            <select class="form-field__value" name="education">
                                <?php foreach ($educations as $education): ?>
                                    <option value="<?= $education['id']; ?>"
                                        <?= $resident['education'] === $education['education'] ? 'selected' : ''; ?>>
                                        <?= $education['education']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--occupation">
                            <label class="form-field__label">Occupation</label>
                            <select class="form-field__value" name="occupation">
                                <?php foreach ($occupations as $occupation): ?>
                                    <option value="<?= $occupation['id']; ?>"
                                        <?= $resident['occupation'] === $occupation['occupation'] ? 'selected' : ''; ?>>
                                        <?= $occupation['occupation']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--family-role">
                            <label class="form-field__label">Family Role</label>
                            <select class="form-field__value" name="familyRole">
                                <?php foreach ($familyRoles as $role): ?>
                                    <option value="<?= $role['id']; ?>" <?= $resident['family_role'] === $role['role'] ? 'selected' : ''; ?>><?= $role['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--marital-status">
                            <label class="form-field__label">Marital Status</label>
                            <select class="form-field__value" name="maritalStatus">
                                <option value="Single" <?= $resident['marital_status'] === 'Single' ? 'selected' : ''; ?>>
                                    Single</option>
                                <option value="Married" <?= $resident['marital_status'] === 'Married' ? 'selected' : ''; ?>>Married</option>
                                <option value="Divorced" <?= $resident['marital_status'] === 'Divorced' ? 'selected' : ''; ?>>Divorced</option>
                                <option value="Widowed" <?= $resident['marital_status'] === 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                            </select>
                        </div>
                        <div class="form-field form-field--created-at">
                            <label class="form-field__label">Data Created At</label>
                            <input class="form-field__value" value="<?= $resident['created_at']; ?>" disabled>
                        </div>
                        <div class="form-field form-field--updated-at">
                            <label class="form-field__label">Data Updated at</label>
                            <input class="form-field__value" value="<?= $resident['updated_at']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form__buttons">
                        <button type="submit" class="form__button form__button--submit">Edit</button>
                        <a class="form__button form__button--cancel"
                            href="/residents/detail?id=<?= $resident['id']; ?>">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php require __DIR__ . '/../components/alerts/info.php' ?>
    <?php require __DIR__ . '/../components/alerts/edit.php' ?>
</body>

</html>