document.querySelectorAll('.footer-link').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelectorAll('.footer-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const roundedBarChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                display: false, // Hide x-axis labels
                grid: {
                    display: false // Hide x-axis grid lines
                }
            },
            y: {
                beginAtZero: true,
                display: false, // Hide y-axis labels
                grid: {
                    display: false // Hide y-axis grid lines
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: true, // Enable tooltips
                callbacks: {
                    label: function(context) {
                        return `${context.dataset.label}: ${context.raw}`;
                    }
                }
            }
        },
        elements: {
            bar: {
                borderRadius: 10,
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderSkipped: false // Ensure corners are rounded on all sides
            }
        },
        layout: {
            padding: 0 // Adjust padding if needed
        }
    };

    const flowVelocityDailyCtx = document.getElementById('flowVelocityDaily').getContext('2d');
    const flowVelocityWeeklyCtx = document.getElementById('flowVelocityWeekly').getContext('2d');
    const debitVolumeDailyCtx = document.getElementById('debitVolumeDaily').getContext('2d');
    const debitVolumeWeeklyCtx = document.getElementById('debitVolumeWeekly').getContext('2d');

    const flowVelocityDailyChart = new Chart(flowVelocityDailyCtx, {
        type: 'bar',
        data: {
            labels: [...Array(30).keys()].map(i => i + 1), // Example daily labels
            datasets: [{
                label: 'Flow Velocity',
                data: Array.from({ length: 30 }, () => Math.floor(Math.random() * 100)),
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderRadius: 10
            }]
        },
        options: roundedBarChartOptions
    });

    const flowVelocityWeeklyChart = new Chart(flowVelocityWeeklyCtx, {
        type: 'bar',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'], // Example weekly labels
            datasets: [{
                label: 'Flow Velocity',
                data: Array.from({ length: 4 }, () => Math.floor(Math.random() * 100)),
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderRadius: 10
            }]
        },
        options: roundedBarChartOptions
    });

    const debitVolumeDailyChart = new Chart(debitVolumeDailyCtx, {
        type: 'bar',
        data: {
            labels: [...Array(30).keys()].map(i => i + 1), // Example daily labels
            datasets: [{
                label: 'Debit Volume',
                data: Array.from({ length: 30 }, () => Math.floor(Math.random() * 100)),
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderRadius: 10
            }]
        },
        options: roundedBarChartOptions
    });

    const debitVolumeWeeklyChart = new Chart(debitVolumeWeeklyCtx, {
        type: 'bar',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'], // Example weekly labels
            datasets: [{
                label: 'Debit Volume',
                data: Array.from({ length: 4 }, () => Math.floor(Math.random() * 100)),
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderRadius: 10
            }]
        },
        options: roundedBarChartOptions
    });
});

function showChart(chartName, period) {
    document.querySelectorAll(`#${chartName}Daily, #${chartName}Weekly`).forEach(canvas => {
        canvas.style.display = 'none';
    });

    document.querySelector(`#${chartName}${capitalizeFirstLetter(period)}`).style.display = 'block';

    document.querySelectorAll(`.${chartName}Tab`).forEach(tab => {
        tab.classList.remove('active');
    });

    document.querySelector(`.${chartName}Tab[data-period="${period}"]`).classList.add('active');
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
