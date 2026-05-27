<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Family Detail — CivicTrack</title>
    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/components/table.css">
    <link rel="stylesheet" href="/css/pages/families/detail.css">
    <link rel="stylesheet" href="/css/components/form-field.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
</head>

<body>
    <div class="layout">
        <?php require __DIR__ . '/../../views/components/sidebar.php'; ?>

        <main class="content">
            <div class="detail">
                <h1 class="detail__title">Family Information</h1>
                <div class="detail__data">
                    <div class="form-field form-field--family-card-number" readonly>
                        <label class="form-field__label">Family Card Number</label>
                        <input class="form-field__value" value="<?= $family['family_card_number']; ?>" readonly>
                    </div>
                    <div class="form-field form-field--address">
                        <label class="form-field__label">Address</label>
                        <input class="form-field__value" value="<?= $family['address']; ?>" readonly>
                    </div>
                    <div class="form-field form-field--neighborhood-unit">
                        <label class="form-field__label">Neighborhood Unit</label>
                        <input class="form-field__value" value="<?= $family['neighborhood_unit']; ?>" readonly>
                    </div>
                    <div class="form-field form-field--community-unit">
                        <label class="form-field__label">Community Unit</label>
                        <input class="form-field__value" value="<?= $family['community_unit']; ?>" readonly>
                    </div>
                    <div class="form-field form-field--created-at">
                        <label class="form-field__label">Created at</label>
                        <input class="form-field__value" value="<?= $family['created_at']; ?>" readonly>
                    </div>
                    <div class="form-field form-field--updated-at">
                        <label class="form-field__label">Updated at</label>
                        <input class="form-field__value" value="<?= $family['updated_at']; ?>" readonly>
                    </div>
                </div>
                <div class="form__buttons">
                    <a href="/families/edit?id=<?= $family['id']; ?>"
                        class="form__button form__button--edit">Edit</a>
                    <form id="deleteForm" action="/families/destroy" method="post">
                        <input type="hidden" name="id" value="<?= $family['id']; ?>">
                        <button type="submit" class="form__button form__button--delete">Delete</button>
                    </form>
                </div>
            </div>

            <div class="content__table">
                <h1 class="content-table__title">Member of Family</h1>
                <table id="residentsTable">
                    <thead>
                        <tr>
                            <th>ID Number</th>
                            <th>Fullname</th>
                            <th>Gender</th>
                            <th>Birthdate</th>
                            <th>Family Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($residents as $resident): ?>
                            <tr>
                                <td>
                                    <a href="/residents/detail?id=<?= $resident['id']; ?>">
                                        <?= $resident['identity_number']; ?>
                                    </a>
                                </td>
                                <td>
                                    <?= $resident['fullname']; ?>
                                </td>
                                <td>
                                    <?= $resident['gender']; ?>
                                </td>
                                <td>
                                    <?= $resident['birthdate']; ?>
                                </td>
                                <td>
                                    <?= $resident['family_role']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="/js/residentsTable.js"></script>

    <?php require __DIR__ . '/../components/alerts/info.php' ?>
    <?php require __DIR__ . '/../components/alerts/delete.php' ?>
</body>

</html>