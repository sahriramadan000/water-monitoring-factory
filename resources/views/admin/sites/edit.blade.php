@extends('admin.layouts.app')

@section('content')
<div class="row mt-2 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('sites.update', [$idFactory, $site->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h5 class="card-title text-center">Update Data Site</h5>
                    <hr>

                    <input type="hidden" class="form-control" id="factory_id" name="factory_id" value="{{ $idFactory }}" required>
                    <div class="mb-3">
                        <label for="topic" class="form-label">Topic</label>
                        <input type="text" class="form-control" id="topic" name="topic" value="{{ $site->topic }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="site_code" class="form-label">Site Code</label>
                        <input type="text" class="form-control" id="site_code" name="site_code" value="{{ $site->site_code }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Site Name</label>
                        <input type="text" name="site_name" class="form-control" id="site_name" value="{{ $site->site_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="site_location" class="form-label">Site Location</label>
                        <input type="text" name="site_location" class="form-control" id="site_location" value="{{ $site->site_location }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" id="status">
                            <option value="1" {{ $site->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$site->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('factories.show', $idFactory) }}" type="button" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
