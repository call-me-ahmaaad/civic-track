<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
    const gender = <?= json_encode($data['total_each_gender']) ?>;
    const age = <?= json_encode($data['total_each_age']) ?>;
    const religion = <?= json_encode($data['total_each_religion']) ?>;
    const occupation = <?= json_encode($data['total_each_occupation']) ?>;
    const education = <?= json_encode($data['total_each_education']) ?>;

    Chart.register(ChartDataLabels);

    const genderChart = new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: {
            labels: Object.keys(gender),
            datasets: [{
                label: 'Count',
                data: Object.values(gender),
                backgroundColor: ['#4A90D9', '#E8A0BF']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' },
                tooltip: { enabled: true },
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold', size: 14 },
                    formatter: (value) => value
                }
            }
        }
    });

    const ageChart = new Chart(document.getElementById('ageChart'), {
        type: 'pie',
        data: {
            labels: Object.keys(age),
            datasets: [{
                label: 'Count',
                data: Object.values(age),
                backgroundColor: [
                    '#1A2A4A',
                    '#4A90D9',
                    '#63B3ED',
                    '#68D391',
                    '#F6AD55',
                    '#FEB2B2',
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' },
                tooltip: { enabled: true },
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold', size: 14 },
                    formatter: (value) => value
                }
            }
        }
    });

    const religionChart = new Chart(document.getElementById('religionChart'), {
        type: 'pie',
        data: {
            labels: religion.map(item => item.religion),
            datasets: [{
                label: 'Count',
                data: religion.map(item => item.total),
                backgroundColor: [
                    '#4A90D9',
                    '#68D391',
                    '#F6AD55',
                    '#B794F4',
                    '#F687B3',
                    '#76E4F7',
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' },
                tooltip: { enabled: true },
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold', size: 14 },
                    formatter: (value) => value
                }
            }
        }
    });

    const occupationChart = new Chart(document.getElementById('occupationChart'), {
        type: 'pie',
        data: {
            labels: occupation.map(item => item.occupation),
            datasets: [{
                label: 'Count',
                data: occupation.map(item => item.total),
                backgroundColor: [
                    '#4A90D9',
                    '#68D391',
                    '#F6AD55',
                    '#B794F4',
                    '#F687B3',
                    '#76E4F7',
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' },
                tooltip: { enabled: true },
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold', size: 14 },
                    formatter: (value) => value
                }
            }
        }
    });

    const educationChart = new Chart(document.getElementById('educationChart'), {
        type: 'pie',
        data: {
            labels: education.map(item => item.education),
            datasets: [{
                label: 'Count',
                data: education.map(item => item.total),
                backgroundColor: [
                    '#4A90D9',
                    '#68D391',
                    '#F6AD55',
                    '#B794F4',
                    '#F687B3',
                    '#76E4F7',
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' },
                tooltip: { enabled: true },
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold', size: 14 },
                    formatter: (value) => value
                }
            }
        }
    });
</script>