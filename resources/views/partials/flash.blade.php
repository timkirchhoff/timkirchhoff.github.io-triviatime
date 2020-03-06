@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

@if(session()->has('alert'))
    <div class="alert alert-danger">
        {{ session()->get('alert') }}
    </div>
@endif
