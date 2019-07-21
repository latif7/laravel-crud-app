@extends('../layouts.admin_master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        500 Error Page
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">500 error</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="error-page">
        <h2 class="headline text-red"> 500</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Something went wrong.</h3>

            <p>
                We will work on fixing that right away. Meanwhile, you may <a href="{{ route('dashboard') }}">return to dashboard</a>
            </p>

        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
<!-- /.content -->
@endsection

