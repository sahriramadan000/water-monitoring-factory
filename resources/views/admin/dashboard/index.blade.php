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
    </style>
@endpush
@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card mb-4">
            <div class="card-body network-diagram p-5">
                <img src="{{ asset('assets/img/image.png') }}" width="550" alt="Network Diagram" class="img-fluid d-block mx-auto">
                <div class="status-container">
                    <div class="status-left">
                        <span class="status-badge status-off" id="status-SS1"></span>
                        <span class="status-badge status-off" id="status-SS3"></span>
                    </div>
                    <div class="status-right">
                        <span class="status-badge status-off" id="status-SS2"></span>
                        <span class="status-badge status-off" id="status-SS4"></span>
                    </div>
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
                        <img src="{{ asset('assets/img/logo-syslab.png') }}" alt="Company Logo" width="210" class="company-logo mt-3 pt-4">
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
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center px-2">
                                    <div class="weather-arrow">
                                        <i class="bi bi-arrow-left"></i>
                                    </div>
                                    <h5 class="card-title fw-bold mb-0">Flow Velocity</h5>
                                    <div class="weather-arrow">
                                        <i class="bi bi-arrow-right"></i>
                                    </div>
                                </div>
                                <div class="tab-menu">
                                    <button class="tab active flowVelocityTab" data-period="daily" onclick="showChart('flowVelocity', 'daily')">Daily</button>
                                    <button class="tab flowVelocityTab" data-period="weekly" onclick="showChart('flowVelocity', 'weekly')">Weekly</button>
                                </div>
                                <div class="chart">
                                    <canvas id="flowVelocityDaily"></canvas>
                                    <canvas id="flowVelocityWeekly" style="display: none;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center px-2">
                                    <div class="weather-arrow">
                                        <i class="bi bi-arrow-left"></i>
                                    </div>
                                    <h5 class="card-title fw-bold mb-0">Debit Volume</h5>
                                    <div class="weather-arrow">
                                        <i class="bi bi-arrow-right"></i>
                                    </div>
                                </div>
                                <div class="tab-menu">
                                    <button class="tab active debitVolumeTab" data-period="daily" onclick="showChart('debitVolume', 'daily')">Daily</button>
                                    <button class="tab debitVolumeTab" data-period="weekly" onclick="showChart('debitVolume', 'weekly')">Weekly</button>
                                </div>
                                <div class="chart">
                                    <canvas id="debitVolumeDaily"></canvas>
                                    <canvas id="debitVolumeWeekly" style="display: none;"></canvas>
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
                        <div class="weather-arrow">
                            <i class="bi bi-arrow-right"></i>
                        </div>
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

    {{-- <div class="col-12 col-md-3">
        <div class="card mb-3">
            <div class="card-body text-center">
                <div class="d-flex justify-content-between align-items-center px-2">
                    <h5 class="card-title fw-bold mb-0">Flow Velocity</h5>
                    <div class="weather-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center py-4">
                    <img src="{{ asset('assets/img/vector.png') }}" alt="" class="img-fluid me-3">
                    <p class="card-text">3.62 m/s</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card mb-3">
            <div class="card-body text-center">
                <div class="d-flex justify-content-between align-items-center px-2">
                    <h5 class="card-title fw-bold mb-0">Debit Volume</h5>
                    <div class="weather-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center py-4">
                    <img src="{{ asset('assets/img/vector.png') }}" alt="" class="img-fluid me-3">
                    <p class="card-text">3.62 m³</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card mb-3">
            <div class="card-body text-center">
                <div class="d-flex justify-content-between align-items-center px-2">
                    <h5 class="card-title fw-bold mb-0">Acidity Score</h5>
                    <div class="weather-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center py-4">
                    <img src="{{ asset('assets/img/Vector3.png') }}" alt="" class="img-fluid me-3">
                    <p class="card-text">7.42</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card mb-3">
            <div class="card-body text-center pb-2">
                <div class="d-flex justify-content-between align-items-center px-2">
                    <h5 class="card-title fw-bold mb-0">Total Credit</h5>
                    <div class="weather-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
                <div class="d-flex flex-column py-3">
                    <p class="card-text mb-0">
                        154,473.00
                    </p>
                    <span class="mb-1" style="font-size: 1rem;">
                        Indonesian Rupiah
                    </span>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection

@push('js-src')
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

</script>
@endpush
