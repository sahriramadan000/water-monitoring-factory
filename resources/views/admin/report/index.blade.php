@extends('admin.layouts.app')

@section('content')
<div class="row align-items-stretch">
    <div class="col-12 col-md-9 d-flex flex-fill">
        <div class="card mb-3 flex-fill">
            <div class="card-body d-flex align-items-center">
                <img src="{{ asset('assets/img/image2.png') }}" alt="Logo" class="mr-3" style="height: 40px;">
                <form action="{{ route('report') }}" method="GET" class="w-100 d-flex gap-3">
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="site_code">Select Site:</label>
                        <select name="site_code" id="site_code" class="form-control w-100">
                            <option value="" disabled selected>Choose Site</option>
                            @foreach($sites as $site)
                                <option value="{{ $site->site_code }}" {{ $site->site_code == $selectedSite ? 'selected' : '' }}>
                                    {{ $site->site_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="type">Select Type:</label>
                        <select name="type" id="type" class="form-control">
                            <option value="day" {{ $type == 'day' ? 'selected' : '' }}>Day</option>
                            <option value="month" {{ $type == 'month' ? 'selected' : '' }}>Month</option>
                            <option value="year" {{ $type == 'year' ? 'selected' : '' }}>Year</option>
                        </select>
                    </div> --}}

                    <div id="dateFields">
                        <div class="d-flex gap-3">
                            <div class="form-group">
                                <label for="dateFrom">Date From:</label>
                                <input type="date" name="dateFrom" id="dateFrom" class="form-control"
                                       value="{{ isset($dateFrom) ? date('Y-m-d', strtotime($dateFrom)) : date('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                <label for="dateTo">Date To:</label>
                                <input type="date" name="dateTo" id="dateTo" class="form-control"
                                       value="{{ isset($dateTo) ? date('Y-m-d', strtotime($dateTo)) : date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="range">Select Range:</label>
                        <select name="range" id="range" class="form-control">
                            <option value="1" {{ $range == '1' ? 'selected' : '' }}>1 Minutes</option>
                            <option value="10" {{ $range == '10' ? 'selected' : '' }}>10 minutes</option>
                            <option value="60" {{ $range == '60' ? 'selected' : '' }}>60 minutes</option>
                        </select>
                    </div>

                    {{-- <div id="monthField" style="display: none;">
                        <div class="form-group">
                            <label for="month">Select Month:</label>
                            <input type="month" name="month" id="month" class="form-control" value="{{ $month }}">
                        </div>
                    </div>

                    <div id="yearField" style="display: none;">
                        <div class="form-group">
                            <label for="year">Select Year:</label>
                            <input type="year" name="year" id="year" class="form-control" value="{{ $year }}">
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label>&nbsp;</label> <!-- Empty label to align the button -->
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3 d-flex flex-fill">
        <div class="card mb-3 flex-fill">
            <a href="#!" id="exportButton" class="card-body d-flex align-items-center justify-content-center" style="color:#516F91; text-decoration: none;">
                <h5 class="mb-0 fw-bolder">Print Report</h5>
            </a>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12 col-md-3">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center px-0 mb-2">
                    <h5 class="card-title fw-bold mb-0">Ph</h5>
                </div>
                <div class="chart-report mt-3">
                    <canvas id="acidityScore"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center px-0 mb-2">
                    <h5 class="card-title fw-bold mb-0">Flow Meter</h5>
                </div>
                <div class="chart-report mt-3">
                    <canvas id="flowVelocity"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center px-0 mb-2">
                    <h5 class="card-title fw-bold mb-0">Total Debit</h5>
                </div>
                <div class="chart-report mt-3">
                    <canvas id="debitVolume"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center px-0 mb-2">
                    <h5 class="card-title fw-bold mb-0">Total Credit</h5>
                </div>
                <div class="chart-report mt-3">
                    <canvas id="totalCredit"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body p-0">
                <table id="table-report" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Site Name</th>
                            <th>Timestamp</th>
                            <th>Ph</th>
                            <th>Flow Velocity</th>
                            <th>Total Debit</th>
                            <th>Total Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataSensors as $dataSensor)
                        <tr>
                            <td>{{ $dataSensor->site_name }}</td>
                            <td>{{ $dataSensor->datetime }}</td>
                            <td>{{ $dataSensor->ph }}</td>
                            <td>{{ $dataSensor->flow }}</td>
                            <td>{{ $dataSensor->total_debit }}</td>
                            <td>{{ $dataSensor->total_credit }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js-src')
<script>
    // Pass the selected site name to JavaScript
    var siteName = "{{ $selectedSiteName }}";
    // Get data from Blade view
    const flowVelocityData = @json($flowVelocityData);
    const debitVolumeData = @json($debitVolumeData);
    const acidityScoreData = @json($acidityScoreData);
    const totalCreditData = @json($totalCreditData);
    const labels = @json($labels);
</script>
<script src="{{ asset('assets/js/report.js') }}"></script>
@endpush
