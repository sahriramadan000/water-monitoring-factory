@extends('admin.layouts.app')

@section('content')
<div class="row align-items-stretch">
    <div class="col-12 col-md-9 d-flex flex-fill">
        <div class="card mb-3 flex-fill">
            <div class="card-body d-flex align-items-center">
                <img src="{{ asset('assets/img/image2.png') }}" alt="Logo" class="mr-3" style="height: 40px;">
                <h5 class="mb-0 fw-bolder">PT. Sumber Jaya Makmur</h5>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3 d-flex flex-fill">
        <div class="card mb-3 flex-fill">
            <a href="#!" onclick="alert('oke')" class="card-body d-flex align-items-center justify-content-center" style="color:#516F91; text-decoration: none;">
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
                    <h5 class="card-title fw-bold mb-0">Flow Velocity</h5>
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
                    <h5 class="card-title fw-bold mb-0">Debit Volume</h5>
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
                    <h5 class="card-title fw-bold mb-0">Acidity Score</h5>
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
                            <th>Timestamp</th>
                            <th>Flow Velocity</th>
                            <th>Debit Volume</th>
                            <th>Acidity Score</th>
                            <th>Total Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>13:34:23, 6 June 2024</td>
                            <td>3.62 m/s</td>
                            <td>42 m³</td>
                            <td>7.42</td>
                            <td>Rp 5,536.43</td>
                        </tr>
                        <tr>
                            <td>13:34:23, 6 June 2024</td>
                            <td>3.62 m/s</td>
                            <td>42 m³</td>
                            <td>7.42</td>
                            <td>Rp 5,536.43</td>
                        </tr>
                        <tr>
                            <td>13:34:23, 6 June 2024</td>
                            <td>3.62 m/s</td>
                            <td>42 m³</td>
                            <td>7.42</td>
                            <td>Rp 5,536.43</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js-src')
<script src="{{ asset('assets/js/report.js') }}"></script>
@endpush
