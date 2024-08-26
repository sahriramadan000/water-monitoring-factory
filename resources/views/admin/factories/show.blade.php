@extends('admin.layouts.app')

@section('content')
<div class="row mt-2">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body px-0">
                <div class="px-3">
                    <div class="d-flex justify-content-between ">
                        <div class="d-flex align-items-center gap-2">
                            <h3>{{ $factory->factory_name }}</h3>
                            @if($factory->status == true)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </div>
                        <a href="{{ route('factories.index') }}" type="button" class="btn btn-danger">Back</a>
                    </div>
                    <p>Address: {{ $factory->factory_address }}</p>
                </div>

                <hr>

                <div class="d-flex justify-content-between px-3">
                    <h4>Sites {{ $factory->factory_name }}</h4>
                    <a href="{{ route('sites.create', $factory->id) }}" class="btn btn-primary">
                        Add Sites
                    </a>
                </div>
                <div class="px-3">
                    @include('admin.components.alert')
                </div>
                <table id="table-sites" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Site Code</th>
                            <th>Topic</th>
                            <th>Site Name</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($factory->sites as $site)
                        <tr>
                            <td>{{ $site->site_code }}</td>
                            <td>{{ $site->topic }}</td>
                            <td>{{ $site->site_name }}</td>
                            <td>{{ $site->site_location }}</td>
                            <td>
                                @if($site->status == true)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('sites.show', [$factory->id, $site->id]) }}" class="btn btn-primary">show</a>
                                <a href="{{ route('sites.edit', [$factory->id, $site->id]) }}" class="btn btn-warning text-white">Edit</a>
                                <form action="{{ route('sites.destroy', [$factory->id, $site->id]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <a href="{{ route('factories.edit', $factory->id) }}" class="btn btn-warning text-white">Edit Factory</a>
                <form action="{{ route('factories.destroy', $factory->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Factory</button>
                </form> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    $('#table-sites').DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "searching": true,
        "order": [[0, 'asc']]
    });
});
</script>
@endpush
