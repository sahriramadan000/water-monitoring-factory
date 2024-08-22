@extends('admin.layouts.app')

@section('content')
<div class="row mt-2">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body px-0">
                <div class="px-3">
                    <div class="d-flex justify-content-between ">
                        <div class="d-flex align-items-center gap-2">
                            <h3>{{ $site->site_name }}</h3>
                            @if($site->status == true)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </div>
                        <a href="{{ route('factories.show', $site->factory_id) }}" type="button" class="btn btn-danger">Back</a>
                    </div>
                    <p>Location: {{ $site->site_location }}</p>
                </div>

                <hr>

                <div class="d-flex justify-content-between px-3">
                    <h4>Sites {{ $site->site_name }}</h4>
                    <a href="{{ route('sensors.create', $site->id) }}" class="btn btn-primary">
                        Add Sensor
                    </a>
                </div>
                <div class="px-3">
                    @include('admin.components.alert')
                </div>
                <table id="table-sensors" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sensor Name</th>
                            <th>Sensor Unit</th>
                            <th>Decimal Point</th>
                            <th>Status</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($site->sensors as $sensor)
                        <tr>
                            <td>{{ $sensor->sensor_name }}</td>
                            <td>{{ $sensor->sensor_unit }}</td>
                            <td>{{ $sensor->decimal_point }}</td>
                            <td>
                                @if($sensor->status == true)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('sensors.edit', [$site->id, $sensor->id]) }}" class="btn btn-warning text-white">Edit</a>
                                <form action="{{ route('sensors.destroy', [$site->id, $sensor->id]) }}" method="POST" style="display:inline-block;">
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
    $('#table-sensors').DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "searching": true,
        "order": [[0, 'asc']]
    });
});
</script>
@endpush
