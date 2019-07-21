
@if(Session::has('success'))
    @if(Session::get('success'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{ Session::get('message') }}
        </div>
    @else
        <div class="alert alert-danger">
            <strong>Error!</strong> {{ Session::get('message') }}
        </div>
    @endif

@endif

@if(Session::has('accessDenied'))
    @if(Session::get('accessDenied'))
        <div class="alert alert-danger">
            <strong>Error!</strong> {{ Session::get('message') }}
        </div>
    @endif

@endif
