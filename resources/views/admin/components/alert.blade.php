@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($message = Session::get('failed'))
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
