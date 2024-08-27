@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12 col-md-2">
        <div class="card mb-3 flex-fill">
            <a href="#!" type="button" onclick="restarGateway()" class="card-body d-flex align-items-center justify-content-center" style="color:#516F91; text-decoration: none;">
                <h5 class="mb-0 fw-bolder">Restart Gateway</h5>
            </a>
        </div>
    </div>
    <div class="col-12 col-md-8">
        {{-- <div class="card mb-3 flex-fill">
            <div class="card-body d-flex align-items-center justify-content-start" style="color:#516F91; text-decoration: none;">
                <h5 class="mb-0 fw-bolder">Factory List</h5>
            </div>
        </div> --}}
    </div>
    <div class="col-12 col-md-2">
        <div class="card mb-3 flex-fill">
            <a href="{{ route('factories.create') }}" class="card-body d-flex align-items-center justify-content-center" style="color:#516F91; text-decoration: none;">
                <h5 class="mb-0 fw-bolder">Add Factory</h5>
            </a>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body p-0">
                <div class="px-3">
                    @include('admin.components.alert')
                </div>
                <table id="table-report" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Factory Code</th>
                            <th>Factory Name</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($factories as $factory)
                        <tr>
                            <td>{{ $factory->id }}</td>
                            <td>{{ $factory->factory_name }}</td>
                            <td>{{ $factory->factory_address }}</td>
                            <td>{{ $factory->status ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <a href="{{ route('factories.show', $factory->id) }}" class="btn btn-primary">show</a>
                                <a href="{{ route('factories.edit', $factory->id) }}" class="btn btn-warning text-white">Edit</a>
                                <form action="{{ route('factories.destroy', $factory->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        {{-- <tr>
                            <td>435456798907</td>
                            <td>PT. Sumber Jaya Makmur</td>
                            <td>8</td>
                            <td>Active</td>
                            <td>
                                <button class="btn btn-sm btn-warning">edit</button>
                                <button class="btn btn-sm btn-primary">show</button>
                                <button class="btn btn-sm btn-danger">delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>435456798907</td>
                            <td>PT. Sumber Jaya Makmur</td>
                            <td>8</td>
                            <td>Active</td>
                            <td>
                                <button class="btn btn-sm btn-warning">edit</button>
                                <button class="btn btn-sm btn-primary">show</button>
                                <button class="btn btn-sm btn-danger">delete</button>
                            </td>
                        </tr> --}}
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
