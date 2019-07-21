@extends('../layouts.admin_master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit User

        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> Users</a></li>
            <li class="active">Edit User</li>
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
                        <h3 class="box-title">Edit User </h3>
                        <a href="{{ route('users.index') }}" class="btn btn-flat btn-info pull-right">Back</a>
                    </div>

                    <br>
                    <div class="row">
                        <div class=" col-sm-offset-2 col-sm-6">
                           @include('partial.alert')
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" id="searchForm1" action="{{ route('users.update', $user->id ) }}">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Name <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ $user->name }}" required placeholder="Enter name" name="name" id="f-name" class="form-control" >
                                    <label class="error ">{{ $errors->first('name') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="email" value="{{ $user->email }}"  required placeholder="Enter email" name="email" id="emailAddress" class="form-control">
                                    <p class="text-danger ">{{ $errors->first('email') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Role <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <select name="role" class="form-control">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}" @if(strtolower(auth()->user()->role) == strtolower($role)) selected @endif>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger ">{{ $errors->first('role') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Password <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="password" placeholder="Enter password" name="password" id="password" class="form-control">
                                    <p class="text-danger ">{{ $errors->first('password') }}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="password" placeholder="Enter Confirm password" name="password_confirmation"  class="form-control">
                                    <p class="text-danger ">{{ $errors->first('password_confirmation') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">	Status</label>
                                <div class="col-sm-6 ">

                                    <label style="line-height: 38px;">
                                        <input type="checkbox"  @if($user->status == 'Active') {{ 'checked' }} @endif data-on-label="On" data-off-label="Off" data-off="warning" name="status"> Active
                                    </label>

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

