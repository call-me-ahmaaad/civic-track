<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Civil Statistic — CivicTrack</title>
    <link rel="shortcut icon" href="/img/civictrack_icon.svg" type="image/x-icon">

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/pages/dashboard/dashboard.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="layout">
        <?php require __DIR__ . '/../../views/components/sidebar.php'; ?>

        <main class="content">
            <div class="content__statistics">
                <div class="statistics-card statistics-card--summary">
                    <div class="summary-item">
                        <h2 class="summary-item__title">Family</h2>
                        <span class="summary-item__value" id="total-family">
                            <?= $data['total_family'] ?>
                        </span>
                    </div>

                    <div class="summary-item">
                        <h2 class="summary-item__title">Resident</h2>
                        <span class="summary-item__value" id="total-resident">
                            <?= $data['total_resident'] ?>
                        </span>
                    </div>
                </div>

                <div class="statistics-card statistics-card--gender">
                    <h2 class="statistics-card__title">Gender Comparison</h2>
                    <div class="statistics-card__chart">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>

                <div class="statistics-card statistics-card--age">
                    <h2 class="statistics-card__title">Age Statistics</h2>
                    <div class="statistics-card__chart">
                        <canvas id="ageChart"></canvas>
                    </div>
                </div>

                <div class="statistics-card statistics-card--religion">
                    <h2 class="statistics-card__title">Religion Statistics</h2>
                    <div class="statistics-card__chart">
                        <canvas id="religionChart"></canvas>
                    </div>
                </div>

                <div class="statistics-card statistics-card--occupation">
                    <h2 class="statistics-card__title">Top 10 Occupation Statistics</h2>
                    <div class="statistics-card__chart">
                        <canvas id="occupationChart"></canvas>
                    </div>
                </div>

                <div class="statistics-card statistics-card--education">
                    <h2 class="statistics-card__title">Education Level Statistics</h2>
                    <div class="statistics-card__chart">
                        <canvas id="educationChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php require __DIR__ . '/../components/chart.php' ?>
    <?php require __DIR__ . '/../components/alert.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/alert.js"></script>
</body>

</html>