<?php /** @var App\Models\Family[] $families */ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Families — CivicTrack</title>
    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/components/table.css">
    <link rel="stylesheet" href="/css/components/form-field.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
</head>

<body>
    <div class="layout">
        <?php require __DIR__ . '/../../views/components/sidebar.php'; ?>

        <main class="content">
            <div class="content__table">
                <h1 class="content-table__title">Families</h1>
                <a class="content-table__button content-table__button--add" href="/families/create">
                    <i class="content-table__button-logo fa-solid fa-plus"></i>
                    <span class="content-table__button-text">Add Family</span>
                </a>
                <table id="familiesTable">
                    <thead>
                        <tr>
                            <th>Family Card Number</th>
                            <th>Address</th>
                            <th>Neighborhood Unit</th>
                            <th>Community Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php /** @var App\Models\Family $family */ ?>
                        <?php foreach ($families as $family): ?>
                            <tr>
                                <td>
                                    <a
                                        href="/families/detail?id=<?= $family->getId() ?>&familyCardNumber=<?= $family->getFamilyCardNumber() ?>">
                                        <?= $family->getFamilyCardNumber() ?>
                                    </a>
                                </td>
                                <td>
                                    <?= $family->getAddress() ?>
                                </td>
                                <td>
                                    <?= $family->getNeighborhoodUnit() ?>
                                </td>
                                <td>
                                    <?= $family->getCommunityUnit() ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <?php require __DIR__ . '/../components/alert.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="/js/tables/familiesTable.js"></script>
    <script src="/js/alert.js"></script>
</body>

</html>