@extends('admin.layouts.app')
@push('style')
    <style>
        .size {
            height: 305px !important;
            overflow-y: auto;
        }
        /* Custom scrollbar styling */
        .size::-webkit-scrollbar {
            width: 6px; /* Width of the scrollbar */
            border-radius: 10px; /* Rounded corners for the scrollbar */
        }

        .size::-webkit-scrollbar-thumb {
            background-color: #b0b0b0; /* Gray color for the scrollbar thumb */
            border-radius: 10px !important; /* Rounded corners for the scrollbar thumb */
        }

        .size::-webkit-scrollbar-track {
            background-color: #f0f0f0; /* Lighter background color for the scrollbar track */
            border-radius: 10px; /* Rounded corners for the scrollbar track */
        }

        /* Remove scrollbar buttons (arrows) */
        .size::-webkit-scrollbar-button {
            display: none; /* Hides the up and down arrows */
        }

        /* For Firefox */
        .size {
            scrollbar-width: thin; /* Thin scrollbar */
            scrollbar-color: #b0b0b0 #f0f0f0; /* Thumb and track colors */
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.7); /* translucent white background */
            z-index: 999; /* Ensure it's above the content */
        }

        .d-none {
            display: none;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
@endpush
@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card mb-4 position-relative">
            <div class="loading-overlay d-none" id="loading-spinner">
                <div class="spinner-border text-primary" role="status"></div>
            </div>
            <div class="card-body network-diagram px-3 pt-5 pb-3" id="site-card">
                <!-- Image element to change dynamically -->
                <img src="{{ asset('assets/img/image.png') }}" width="525" alt="Network Diagram" class="img-fluid d-block mx-auto" id="network-image">

                <!-- Status Container (unchanged) -->
                <div class="status-container" id="site-status">
                    <div class="status-left">
                        <span class="status-badge status-off" id="status-SS1"></span>
                        <span class="status-badge status-off" id="status-SS3"></span>
                    </div>
                    <div class="status-right">
                        <span class="status-badge status-off" id="status-SS2"></span>
                        <span class="status-badge status-off" id="status-SS4"></span>
                    </div>
                </div>

                <div class="navigation-icons d-flex gap-3 mt-3">
                    <button id="left-arrow" class="btn btn-primary w-100" style="border-radius: 10px !important;" onclick="switchSites('left')">Page 1</button>
                    <button id="right-arrow" class="btn btn-primary w-100" style="border-radius: 10px !important;" onclick="switchSites('right')">Page 2</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card mb-4 company-card {{ $currentFactory->status == true ? 'factory-active' : 'factory-inactive' }}">
                    {{-- <div class="status-indicator"></div> --}}
                    <div class="refresh-icon">
                        <a href="#!">
                            <i class="bi bi-arrows" style="font-size: 1.5rem;" data-factory-id="{{ $nextFactory->id }}"></i>
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/img/logo-systronika.png') }}" alt="Company Logo" width="270" class="company-logo mt-3 pt-4">
                        <h5 class="card-title mt-3">{{ $currentFactory->factory_name }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card mb-4 company-card {{ $currentSite->status == true ? 'factory-active' : 'factory-inactive' }}">
                    {{-- <div class="status-indicator"></div> --}}
                    <div class="refresh-icon">
                        <a href="#!">
                            <i class="bi bi-arrows" style="font-size: 1.5rem;"
                               data-site-id="{{ $nextSite->id }}"></i>
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/img/image2.png') }}" alt="Company Logo" width="88" class="company-logo mt-3">
                        <h5 class="card-title mt-3">{{ $currentSite->site_name }}</h5>
                    </div>
                </div>
            </div>
            {{-- <div class="col-12 col-md-6">
                <div class="weather-card card mb-3">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title weather-title mb-0">Weather</h5>
                            <div class="weather-arrow">
                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                        <div class="weather-info mt-3">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="font-weight-bold mb-0">Rasht</h5>
                                            </div>
                                            <div class="col-12">
                                                <div class="weather-container">
                                                    <div class="temp me-3">14°C</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="weather-details">
                                                    <div class="temp-range"><span style="color: blue;">3°C</span> / <span style="color: orange;">16°C</span></div>
                                                    <div class="weather-status">Partly Cloudy</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="weather-icon">
                                                    <img src="{{ asset('assets/img/weather-icon.png') }}" alt="Weather Icon" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center px-2">
                            <h5 class="card-title fw-bold mb-0">Site List</h5>
                            <a href="{{ route('factories.show', $currentFactory->id) }}" class="weather-arrow">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <ul class="list-group list-group-flush mt-2 px-2 size">
                            @forelse($currentFactory->sites as $key => $site)
                            <li class="list-group-item {{ $site->status ? 'site-active' : 'site-inactive' }}">{{ $site->site_name }}</li>
                            @empty
                            <li class="list-group-item mx-auto">Site Not Found</li>
                            @endforelse
                        </ul>
                        <div class="mt-2 d-flex justify-content-around">
                            <span class="">{{ $activeSitesCount }} Active</span>
                            <span>|</span>
                            <span class="">{{ $inactiveSitesCount }} Inactive</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4" id="flow-chart">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center px-2">
                                    <div class="weather-arrow">
                                        <i class="bi bi-arrow-left"></i>
                                    </div>
                                    <h5 class="card-title fw-bold mb-0">Flow Meter</h5>
                                    <div class="weather-arrow">
                                        <i class="bi bi-arrow-right"></i>
                                    </div>
                                </div>
                                <div class="chart">
                                    <canvas id="flowMeterDaily"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4 d-none" id="total-debit-chart">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center px-2">
                                    <div class="weather-arrow">
                                        <i class="bi bi-arrow-left"></i>
                                    </div>
                                    <h5 class="card-title fw-bold mb-0">Total Debit</h5>
                                    <div class="weather-arrow">
                                        <i class="bi bi-arrow-right"></i>
                                    </div>
                                </div>
                                <div class="chart">
                                    <canvas id="totalDebit"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card mb-4" id="ph-chart">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center px-2">
                                    <div class="weather-arrow2">
                                        <i class="bi bi-arrow-left"></i>
                                    </div>
                                    <h5 class="card-title fw-bold mb-0">Ph</h5>
                                    <div class="weather-arrow2">
                                        <i class="bi bi-arrow-right"></i>
                                    </div>
                                </div>
                                <div class="chart">
                                    <canvas id="phDaily"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4 d-none" id="total-credit-chart">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center px-2">
                                    <div class="weather-arrow2">
                                        <i class="bi bi-arrow-left"></i>
                                    </div>
                                    <h5 class="card-title fw-bold mb-0">Total Credit</h5>
                                    <div class="weather-arrow2">
                                        <i class="bi bi-arrow-right"></i>
                                    </div>
                                </div>
                                <div class="chart">
                                    <canvas id="totalCredit"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    @foreach($currentSite->sensors as $sensor)
        <div class="col-12 col-md-3">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <div class="d-flex justify-content-between align-items-center px-2">
                        <h5 class="card-title fw-bold mb-0">{{ $sensor->sensor_name }}</h5>
                    </div>
                    <div class="d-flex justify-content-center align-items-center py-4">
                        @if($sensor->sensor_unit == 'Rp')
                            <p class="card-text">{{ $sensor->sensor_unit }} <span id="value-{{ $currentSite->site_code }}-{{ $sensor->sensor_ident }}" class="rupiah-value">-</span></p>
                        @else
                            <p class="card-text"><span id="value-{{ $currentSite->site_code }}-{{ $sensor->sensor_ident }}">-</span> {{ $sensor->sensor_unit }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('js-src')
<script>
    $('.weather-arrow').click(function() {
        // Get the current visible chart and the hidden chart
        let visibleChart = $('#flow-chart').hasClass('d-none') ? '#total-debit-chart' : '#flow-chart';
        let hiddenChart = $('#flow-chart').hasClass('d-none') ? '#flow-chart' : '#total-debit-chart';

        // Toggle the visibility
        $(visibleChart).addClass('d-none');
        $(hiddenChart).removeClass('d-none');
    });
    $('.weather-arrow2').click(function() {
        // Get the current visible chart and the hidden chart
        let visibleChart = $('#ph-chart').hasClass('d-none') ? '#total-credit-chart' : '#ph-chart';
        let hiddenChart = $('#ph-chart').hasClass('d-none') ? '#ph-chart' : '#total-credit-chart';

        // Toggle the visibility
        $(visibleChart).addClass('d-none');
        $(hiddenChart).removeClass('d-none');
    });

    const flowVelocityData = @json($flowVelocityData);
    const debitVolumeData = @json($debitVolumeData);
    const acidityScoreData = @json($acidityScoreData);
    const totalCreditData = @json($totalCreditData);
    const labels = @json($labels);

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

        const roundedBarChartCreditOptions = {
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
                            const value = context.raw;
                            return `${context.dataset.label}: Rp ${value.toLocaleString('id-ID')}`;
                        }
                    }
                }
            },
            elements: {
                bar: {
                    borderRadius: 10,
                    backgroundColor: 'rgba(138, 30, 30, 0.8)',
                    borderSkipped: false // Ensure corners are rounded on all sides
                }
            },
            layout: {
                padding: 0 // Adjust padding if needed
            }
        };

        const flowMeterDailyCtx = document.getElementById('flowMeterDaily').getContext('2d');
        const phDailyCtx = document.getElementById('phDaily').getContext('2d');
        const totalDebitCtx = document.getElementById('totalDebit').getContext('2d');
        const totalCreditCtx = document.getElementById('totalCredit').getContext('2d');

        const debitDailyChart = new Chart(totalDebitCtx, {
            type: 'bar',
            data: {
                labels: labels, // Use dynamic labels
                datasets: [{
                    label: 'Total Debit',
                    data: debitVolumeData, // Use dynamic data
                    backgroundColor: 'rgba(30, 58, 138, 0.8)',
                    borderRadius: 10
                }]
            },
            options: roundedBarChartOptions
        });

        const creditDailyChart = new Chart(totalCreditCtx, {
            type: 'bar',
            data: {
                labels: labels, // Use dynamic labels
                datasets: [{
                    label: 'Total Debit',
                    data: totalCreditData, // Use dynamic data
                    backgroundColor: 'rgba(30, 58, 138, 0.8)',
                    borderRadius: 10
                }]
            },
            options: roundedBarChartCreditOptions
        });

        const flowMeterDailyChart = new Chart(flowMeterDailyCtx, {
            type: 'bar',
            data: {
                labels: labels, // Use dynamic labels
                datasets: [{
                    label: 'Flow Meter',
                    data: flowVelocityData, // Use dynamic data
                    backgroundColor: 'rgba(30, 58, 138, 0.8)',
                    borderRadius: 10
                }]
            },
            options: roundedBarChartOptions
        });

        const phDailyChart = new Chart(phDailyCtx, {
            type: 'bar',
            data: {
                labels: labels, // Use dynamic labels
                datasets: [{
                    label: 'Ph',
                    data: acidityScoreData, // Use dynamic data
                    backgroundColor: 'rgba(30, 58, 138, 0.8)',
                    borderRadius: 10
                }]
            },
            options: roundedBarChartOptions
        });
    });
</script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@push('js')
<script>
   document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.refresh-icon i').forEach(function(button) {
            button.addEventListener('click', function() {
                const nextFactoryId = this.getAttribute('data-factory-id');
                const nextSiteId = this.getAttribute('data-site-id');
                const currentUrl = new URL(window.location.href);

                // Show the "Processing" alert
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we update the data.',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        // Update the URL based on the type of refresh action
                        if (nextFactoryId) {
                            currentUrl.searchParams.set('current_factory_id', nextFactoryId);
                        }
                        if (nextSiteId) {
                            currentUrl.searchParams.set('current_site_id', nextSiteId);
                        }

                        // Redirect to the updated URL
                        window.location.href = currentUrl.toString();
                    }
                });
            });
        });

        // Show a success alert when the page loads if there was a factory or site switch
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('current_factory_id') || urlParams.has('current_site_id')) {
            Swal.fire({
                title: 'Success!',
                text: 'Data updated successfully.',
                icon: 'success',
                timer: 1000,
                showConfirmButton: false
            });
        }
    });


</script>
<script>
    socket.on('connect', () => {
        console.log('Connected to the server');
    });

    // Function to format a number as Rupiah
    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(value);
    }

    let siteCodesFromDb = @json($getSiteCode);
    let sensorIdentFromDb = @json($getSensorIdent);
    let noDataTimeout;

    // Function to mark all sites as off
    function markAllSitesOff() {
        siteCodesFromDb.forEach(function(siteCode) {
            let elementStatusId = `status-${siteCode}`;
            $('#' + elementStatusId).removeClass('status-on').addClass('status-off');

            sensorIdentFromDb.forEach(sensorIdent => {
                let elementId = `value-${siteCode}-${sensorIdent}`;
                let element = document.getElementById(elementId);

                if (element) {
                    element.innerText = '-';
                }
            });
        });
    }

    // Function to handle received data
    function handleRealtimeData(data) {
        console.log('Data:', data);

        if (data.factory_code && data.site_code) {
            // Iterate over each sensor data
            Object.keys(data.data).forEach(function(sensor) {
                // Construct the element ID based on site_code and sensor identifier
                let elementId = `value-${data.site_code}-${sensor}`;
                let elementStatusId = `status-${data.site_code}`;

                // Check if the element exists in the DOM
                let element = document.getElementById(elementId);
                if (element) {
                    let sensorValue = data.data[sensor];

                    // Check if the sensor unit is Rupiah ('Rp')
                    if (element.closest('.card-text').innerText.includes('Rp')) {
                        // Update the element text with the formatted Rupiah value
                        element.innerText = formatRupiah(sensorValue);
                    } else {
                        // Update the element text with the raw sensor value
                        element.innerText = sensorValue;
                    }
                }

                if (siteCodesFromDb.includes(data.site_code)) {
                    $('#' + elementStatusId).removeClass('status-off').addClass('status-on');
                }
            });
        }
    }

    // Listen for the realtimeMonitor socket event
    socket.on('realtimeMonitor', function(data) {
        // Clear the previous timeout as new data is received
        clearTimeout(noDataTimeout);

        // Handle the incoming data
        handleRealtimeData(data);

        // Reset the timeout to mark all sites as off if no new data is received within the interval
        noDataTimeout = setTimeout(function() {
            markAllSitesOff();
        }, 3000); // Adjust the interval as needed
    });

    // Initial call to mark all sites off if no data is received immediately after connection
    markAllSitesOff();

    // =========================================================================================================
    let currentSet = 1; // Start with the first set of sites (1-2)
    const images = {
        1: "{{ asset('assets/img/image.png') }}",
        2: "{{ asset('assets/img/image1.png') }}",
    };

    function showLoading() {
        const loadingSpinner = document.getElementById('loading-spinner');
        loadingSpinner.classList.remove('d-none');
    }

    function hideLoading() {
        const loadingSpinner = document.getElementById('loading-spinner');
        loadingSpinner.classList.add('d-none');
    }

    function switchSites(direction) {
        showLoading(); // Show loading indicator

        setTimeout(() => {
            const siteStatus = document.getElementById('site-status');
            const imageElement = document.getElementById('network-image'); // Get the image element

            if (direction === 'left') {
                currentSet = Math.max(1, currentSet - 1); // Limit to 1
            } else if (direction === 'right') {
                currentSet = Math.min(2, currentSet + 1); // Limit to 2
            }

            // Change image based on the current set
            imageElement.src = images[currentSet];

            // Update status badges based on current set
            if (currentSet === 1) {
                siteStatus.innerHTML = `
                    <div class="status-left">
                        <span class="status-badge status-off" id="status-SS1"></span>
                        <span class="status-badge status-off" id="status-SS3"></span>
                    </div>
                    <div class="status-right">
                        <span class="status-badge status-off" id="status-SS2"></span>
                        <span class="status-badge status-off" id="status-SS4"></span>
                    </div>
                `;
            } else if (currentSet === 2) {
                siteStatus.innerHTML = `
                    <div class="status-left">
                        <span class="status-badge status-off" id="status-SS5"></span>
                        <span class="status-badge status-off" id="status-SS7"></span>
                    </div>
                    <div class="status-right">
                        <span class="status-badge status-off" id="status-SS6"></span>
                        <span class="status-badge status-off" id="status-SS8"></span>
                    </div>
                `;
            } else if (currentSet === 3) {
                // Update for set 3
            } else if (currentSet === 4) {
                // Update for set 4
            }

            hideLoading(); // Hide loading indicator after update
        }, 1000); // Simulate a 1 second loading time
    }


</script>
@endpush
