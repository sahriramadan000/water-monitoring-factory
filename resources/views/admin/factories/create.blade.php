@extends('admin.layouts.app')

@section('content')

<div class="row mt-2 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('factories.store') }}" method="POST">
                    @csrf

                    <h5 class="card-title text-center">Create Factory</h5>
                    <hr>
                    <div class="mb-3">
                        <label for="factory_code" class="form-label">Factory Code</label>
                        <input type="text" class="form-control" id="factory_code" name="factory_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="factory_name" class="form-label">Factory Name</label>
                        <input type="text" class="form-control" id="factory_name" name="factory_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="factory_address" class="form-label">Factory Address</label>
                        <input type="text" class="form-control" id="factory_address" name="factory_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="factory_status" class="form-label">Status</label>
                        <select class="form-control" id="factory_status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('factories.index') }}" type="button" class="btn btn-danger">Back</a>
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
