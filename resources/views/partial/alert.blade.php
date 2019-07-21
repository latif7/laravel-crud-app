
@if(Session::has('successMessage'))
    <div class="alert alert-success">
        <strong>Success!</strong> {{ Session::get('successMessage') }}
    </div>
@endif

@if(Session::has('errorMessage'))
    <div class="alert alert-danger">
        <strong>Error!</strong> {{ Session::get('errorMessage') }}
    </div>
@endif


@if(Session::has('accessDenied'))
    <div class="alert alert-danger">
        <strong>Error!</strong> {{ Session::get('accessDenied') }}
    </div>
@endif
