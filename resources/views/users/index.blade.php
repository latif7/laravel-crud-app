@extends('../layouts.admin_master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Users</li>
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
                        <h3 class="box-title">Create User</h3>
                    </div>

                    <br>
                    <div class="row">
                        <div class=" col-sm-offset-2 col-sm-6">
                            @include('partial.alert')
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" id="searchForm1" action="{{ route('users.store') }}">
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Name <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ old('name') }}" required placeholder="Enter name" name="name" id="f-name" class="form-control" >
                                    <label class="error ">{{ $errors->first('name') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Role <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <select name="role" class="form-control">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}" @if(old('role') == $role) selected @endif>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger ">{{ $errors->first('role') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="email" value="{{ old('email') }}"  required placeholder="Enter email" name="email" id="emailAddress" class="form-control">
                                    <p class="text-danger ">{{ $errors->first('email') }}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Password <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="password" placeholder="Enter password" required name="password" id="password" class="form-control">
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
                                <label class="col-lg-2 control-label">	Status</label>
                                <div class="col-sm-6 ">

                                    <label style="line-height: 38px;">
                                         <input type="checkbox"  @if(old('status')=='on') {{ 'checked' }} @endif data-on-label="On" data-off-label="Off" data-off="warning" name="status"> Active
                                    </label>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="reset" class="btn btn-default">Clear</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.col (right) -->
        </div>

        <div class="row">
            <div class="col-xs-12, col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div style="overflow-x: auto;">
                            {{--                            {!! $dataTable->table() !!}--}}

                            <table class="table table-bordered table-striped table-condensed" id="clientTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Created By</th>
                                    <th>Updated At</th>
                                    <th>Updated By</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>

                                        <td>

                                            <span class="label @if($user->status == 'Active') {{ 'label-success' }}@else {{ 'label-danger'  }}@endif">{{ $user->status }}</span>
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ isset($user->createdBy->name) ? $user->createdBy->name:'System' }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>{{ isset($user->updatedBy->name) ? $user->updatedBy->name:'--' }}</td>
                                        {{--                                        <td>{{ $user->updatedBy->name or '--' }}</td>--}}
                                        <td class="text-center">
                                            <form action="">
                                                @csrf
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>
{{--                                                <button type="button" class="btn btn-xs btn-danger " ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>--}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->


    </section>
@endsection

@section('scripts')
<script>

</script>

@endsection

