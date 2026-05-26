<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Resident — CivicTrack</title>
    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/pages/residents/create.css">
    <link rel="stylesheet" href="/css/components/form-field.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="layout">
        <?php require __DIR__ . '/../../views/components/sidebar.php'; ?>

        <main class="content">
            <div class="create">
                <h1 class="create__title">Resident Information</h1>
                <form id="createForm" action="/residents/store" method="post">
                    <div class="create__data">
                        <div class="form-field form-field--identity-number" readonly>
                            <label class="form-field__label">Identity Number</label>
                            <input class="form-field__value" name="identityNumber" type="text">
                        </div>
                        <div class="form-field form-field--family-card-number">
                            <label class="form-field__label">Family Number</label>
                            <input class="form-field__value" name="familyCardNumber" type="text">
                        </div>
                        <div class="form-field form-field--fullname">
                            <label class="form-field__label">Fullname</label>
                            <input class="form-field__value" name="fullname" type="text">
                        </div>
                        <div class="form-field form-field--gender">
                            <label class="form-field__label">Gender</label>
                            <select class="form-field__value" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-field form-field--birthplace">
                            <label class="form-field__label">Birthplace</label>
                            <select class="form-field__value" name="birthplace">
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?= $city['id']; ?>"><?= $city['city']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--birthdate">
                            <label class="form-field__label">Birthdate</label>
                            <input class="form-field__value" name="birthdate" type="date">
                        </div>
                        <div class="form-field form-field--religion">
                            <label class="form-field__label">Religion</label>
                            <select class="form-field__value" name="religion">
                                <?php foreach ($religions as $religion): ?>
                                    <option value="<?= $religion['id']; ?>"><?= $religion['religion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--education">
                            <label class="form-field__label">Education Level</label>
                            <select class="form-field__value" name="education">
                                <?php foreach ($educations as $education): ?>
                                    <option value="<?= $education['id']; ?>"><?= $education['education']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--occupation">
                            <label class="form-field__label">Occupation</label>
                            <select class="form-field__value" name="occupation">
                                <?php foreach ($occupations as $occupation): ?>
                                    <option value="<?= $occupation['id']; ?>"><?= $occupation['occupation']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--family-role">
                            <label class="form-field__label">Family Role</label>
                            <select class="form-field__value" name="familyRole">
                                <?php foreach ($familyRoles as $role): ?>
                                    <option value="<?= $role['id']; ?>"><?= $role['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-field form-field--marital-status">
                            <label class="form-field__label">Marital Status</label>
                            <select class="form-field__value" name="maritalStatus">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                    </div>
                    <div class="form__buttons">
                        <button type="submit" class="form__button form__button--submit">Create</button>
                        <a class="form__button form__button--cancel" href="/residents">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php require __DIR__ . '/../components/alerts/info.php' ?>
    <?php require __DIR__ . '/../components/alerts/create.php' ?>
</body>

</html>