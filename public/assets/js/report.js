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
    new Chart(flowVelocityCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Flow Velocity',
                data: flowVelocityData,
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderRadius: 10
            }]
        },
        options: roundedBarChartOptions
    });

    // Initialize Debit Volume chart
    const debitVolumeCtx = document.getElementById('debitVolume').getContext('2d');
    new Chart(debitVolumeCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Debit Volume',
                data: debitVolumeData,
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderRadius: 10
            }]
        },
        options: roundedBarChartOptions
    });

    // Initialize Acidity Score chart
    const acidityScoreCtx = document.getElementById('acidityScore').getContext('2d');
    new Chart(acidityScoreCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Acidity Score',
                data: acidityScoreData,
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderRadius: 10
            }]
        },
        options: roundedBarChartOptions
    });

    // Initialize Total Credit chart
    const totalCreditCtx = document.getElementById('totalCredit').getContext('2d');
    new Chart(totalCreditCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Credit',
                data: totalCreditData,
                backgroundColor: 'rgba(30, 58, 138, 0.8)',
                borderRadius: 10
            }]
        },
        options: roundedBarChartOptions
    });
});


$(document).ready(function() {
    let table = $('#table-report').DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "searching": true,
        "order": [[0, 'asc']],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: function() {
                    // Get the current date and time
                    let now = new Date();
                    let dateString = now.toISOString().split('T')[0];  // YYYY-MM-DD
                    let timeString = now.toTimeString().split(' ')[0];  // HH:MM:SS
                    // Include site name in the title
                    return 'Sensor Report - ' + siteName + ' ' + dateString + ' ' + timeString;
                },
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]  // Adjust according to the columns you want to export
                },
                className: 'd-none'  // Hide the button
            }
        ]
    });

    // On click of the custom button, trigger the hidden Excel button
    $('#exportButton').on('click', function() {
        table.button('.buttons-excel').trigger();  // Trigger the export
    });

    function toggleFields() {
        var selectedType = $('#type').val();

        if (selectedType === 'day') {
            $('#dateFields').show();
            $('#monthField').hide();
            $('#yearField').hide();
        } else if (selectedType === 'month') {
            $('#dateFields').hide();
            $('#monthField').show();
            $('#yearField').hide();
        } else if (selectedType === 'year') {
            $('#dateFields').hide();
            $('#monthField').hide();
            $('#yearField').show();
        }
    }

    // Run on page load
    toggleFields();

    // Run when type changes
    $('#type').change(function() {
        toggleFields();
    });
});
