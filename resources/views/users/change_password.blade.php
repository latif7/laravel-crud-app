@extends('../layouts.admin_master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Change Password

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Change Password</li>
        </ol>
    </section>

    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <!-- right column -->
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Change Password </h3>
                    </div>

                    <br>
                    <div class="row">
                        <div class=" col-sm-offset-2 col-sm-6">
                            @include('partial.alert')
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{ route('users.change-password') }}">
{{--                       {{ dd($errors->all())}}--}}
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-lg-2 control-label" id="oldPassword">Old Password <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="password"  required placeholder="Enter Old Password" name="old_password"  class="form-control">
                                    <p class="text-danger ">{{ $errors->first('old_password') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Password <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="password" required placeholder="Enter password" name="password" id="password" class="form-control">
                                    <p class="text-danger ">{{ $errors->first('password') }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="password" required placeholder="Enter Confirm password" name="password_confirmation"  class="form-control">
                                    <p class="text-danger ">{{ $errors->first('password_confirmation') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="reset" class="btn btn-default">Clear</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.col (right) -->
        </div>

    </section>
@endsection

@section('scripts')
    <script>

    </script>

@endsection

