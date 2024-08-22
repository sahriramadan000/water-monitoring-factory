@extends('admin.layouts.app')

@section('content')

<div class="row mt-2 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('sensors.store', $idSite) }}" method="POST">
                    @csrf

                    <h5 class="card-title text-center">Create Sensor</h5>
                    <hr>
                    <input type="hidden" class="form-control" id="site_id" name="site_id" value="{{ $idSite }}" required>

                    <div class="mb-3">
                        <label for="sensor_ident" class="form-label">Sensor Ident</label>
                        <input type="text" class="form-control" id="sensor_ident" name="sensor_ident" required>
                    </div>
                    <div class="mb-3">
                        <label for="sensor_name" class="form-label">Sensor Name</label>
                        <input type="text" class="form-control" id="sensor_name" name="sensor_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="sensor_unit" class="form-label">Sensor Unit</label>
                        <input type="text" class="form-control" id="sensor_unit" name="sensor_unit" required>
                    </div>
                    <div class="mb-3">
                        <label for="decimal_point" class="form-label">Decimal Point</label>
                        <input type="number" min="0" class="form-control" id="decimal_point" name="decimal_point" required>
                    </div>
                    <div class="mb-3">
                        <label for="sensor_status" class="form-label">Status</label>
                        <select class="form-control" id="sensor_status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('sites.show', [$site->factory_id, $site->id]) }}" type="button" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js-src')
@endpush
