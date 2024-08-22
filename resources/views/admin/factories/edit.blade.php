@extends('admin.layouts.app')

@section('content')
<div class="row mt-2 justify-content-center">
    <div class="col-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('factories.update', $factory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h5 class="card-title text-center">Update Data Factory</h5>
                    <hr>

                    <div class="mb-3">
                        <label for="factory_code" class="form-label">Factory Code</label>
                        <input type="text" class="form-control" id="factory_code" name="factory_code" value="{{ $factory->factory_code }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="factory_name" class="form-label">Factory Name</label>
                        <input type="text" name="factory_name" class="form-control" id="factory_name" value="{{ $factory->factory_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="factory_address" class="form-label">Factory Address</label>
                        <input type="text" name="factory_address" class="form-control" id="factory_address" value="{{ $factory->factory_address }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" id="status">
                            <option value="1" {{ $factory->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$factory->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('factories.index') }}" type="button" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
