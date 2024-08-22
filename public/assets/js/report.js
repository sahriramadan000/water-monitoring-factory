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

    // Initialize Flow Velocity chart
    const flowVelocityCtx = document.getElementById('flowVelocity').getContext('2d');
    const flowVelocityChart = new Chart(flowVelocityCtx, {
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

    // Initialize Debit Volume chart
    const debitVolumeCtx = document.getElementById('debitVolume').getContext('2d');
    const debitVolumeChart = new Chart(debitVolumeCtx, {
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

    // Initialize Acidity Score chart
    const acidityScoreCtx = document.getElementById('acidityScore').getContext('2d');
    const acidityScoreChart = new Chart(acidityScoreCtx, {
        type: 'bar',
        data: {
            labels: [...Array(30).keys()].map(i => i + 1), // Example daily labels
            datasets: [{
                label: 'Acidity Score',
                data: Array.from({ length: 30 }, () => Math.floor(Math.random() * 100)),
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderRadius: 10
            }]
        },
        options: roundedBarChartOptions
    });

    // Initialize Total Credit chart
    const totalCreditCtx = document.getElementById('totalCredit').getContext('2d');
    const totalCreditChart = new Chart(totalCreditCtx, {
        type: 'bar',
        data: {
            labels: [...Array(30).keys()].map(i => i + 1), // Example daily labels
            datasets: [{
                label: 'Total Credit',
                data: Array.from({ length: 30 }, () => Math.floor(Math.random() * 100)),
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderRadius: 10
            }]
        },
        options: roundedBarChartOptions
    });
});


$(document).ready(function() {
    $('#table-report').DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "searching": true,
        "order": [[0, 'asc']]
    });
});
