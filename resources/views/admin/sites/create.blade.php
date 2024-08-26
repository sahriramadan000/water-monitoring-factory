@extends('admin.layouts.app')

@section('content')

<div class="row mt-2 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('sites.store', $idFactory) }}" method="POST">
                    @csrf

                    <h5 class="card-title text-center">Create Site</h5>
                    <hr>
                    <input type="hidden" class="form-control" id="factory_id" name="factory_id" value="{{ $idFactory }}" required>

                    <div class="mb-3">
                        <label for="topic" class="form-label">Topic</label>
                        <input type="text" class="form-control" id="topic" name="topic" required>
                    </div>

                    <div class="mb-3">
                        <label for="site_code" class="form-label">Site Code</label>
                        <input type="text" class="form-control" id="site_code" name="site_code" required>
                    </div>

                    <div class="mb-3">
                        <label for="site_name" class="form-label">Site Name</label>
                        <input type="text" class="form-control" id="site_name" name="site_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="site_location" class="form-label">Site Location</label>
                        <input type="text" class="form-control" id="site_location" name="site_location" required>
                    </div>
                    <div class="mb-3">
                        <label for="site_status" class="form-label">Status</label>
                        <select class="form-control" id="site_status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('factories.show', $idFactory) }}" type="button" class="btn btn-danger">Back</a>
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
