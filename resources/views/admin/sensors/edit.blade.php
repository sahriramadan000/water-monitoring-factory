@extends('admin.layouts.app')

@section('content')
<div class="row mt-2 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('sensors.update', [$idSite, $sensor->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h5 class="card-title text-center">Update Data Site</h5>
                    <hr>

                    <input type="hidden" class="form-control" id="site_id" name="site_id" value="{{ $idSite }}" required>
                    <div class="mb-3">
                        <label for="sensor_ident" class="form-label">Sensor Ident</label>
                        <input type="text" class="form-control" id="sensor_ident" name="sensor_ident" value="{{ $sensor->sensor_ident }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sensor_name" class="form-label">Sensor Name</label>
                        <input type="text" name="sensor_name" class="form-control" id="sensor_name" value="{{ $sensor->sensor_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sensor_unit" class="form-label">Sensor Unit</label>
                        <input type="text" name="sensor_unit" class="form-control" id="sensor_unit" value="{{ $sensor->sensor_unit }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="decimal_point" class="form-label">Decimal Point</label>
                        <input type="number" min="0" name="decimal_point" class="form-control" id="decimal_point" value="{{ $sensor->decimal_point }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" id="status">
                            <option value="1" {{ $sensor->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$sensor->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('sites.show', [$site->factory_id, $idSite]) }}" type="button" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
