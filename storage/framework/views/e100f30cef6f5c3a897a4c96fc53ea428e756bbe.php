<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                            <?php echo $__env->make('partial.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" id="searchForm1" action="<?php echo e(route('users.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Name <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="text" value="<?php echo e(old('name')); ?>" required placeholder="Enter name" name="name" id="f-name" class="form-control" >
                                    <label class="error "><?php echo e($errors->first('name')); ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Role <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <select name="role" class="form-control">
                                        <option value="">Select Role</option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role); ?>" <?php if(old('role') == $role): ?> selected <?php endif; ?>><?php echo e($role); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <p class="text-danger "><?php echo e($errors->first('role')); ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="email" value="<?php echo e(old('email')); ?>"  required placeholder="Enter email" name="email" id="emailAddress" class="form-control">
                                    <p class="text-danger "><?php echo e($errors->first('email')); ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Password <span class="text-danger"> *</span></label>
                                <div class="col-lg-6">
                                    <input type="password" placeholder="Enter password" required name="password" id="password" class="form-control">
                                    <p class="text-danger "><?php echo e($errors->first('password')); ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="password" required placeholder="Enter Confirm password" name="password_confirmation"  class="form-control">
                                    <p class="text-danger "><?php echo e($errors->first('password_confirmation')); ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">	Status</label>
                                <div class="col-sm-6 ">

                                    <label style="line-height: 38px;">
                                         <input type="checkbox"  <?php if(old('status')=='on'): ?> <?php echo e('checked'); ?> <?php endif; ?> data-on-label="On" data-off-label="Off" data-off="warning" name="status"> Active
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
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e($user->role); ?></td>

                                        <td>

                                            <span class="label <?php if($user->status == 'Active'): ?> <?php echo e('label-success'); ?><?php else: ?> <?php echo e('label-danger'); ?><?php endif; ?>"><?php echo e($user->status); ?></span>
                                        </td>
                                        <td><?php echo e($user->created_at); ?></td>
                                        <td><?php echo e(isset($user->createdBy->name) ? $user->createdBy->name:'System'); ?></td>
                                        <td><?php echo e($user->updated_at); ?></td>
                                        <td><?php echo e(isset($user->updatedBy->name) ? $user->updatedBy->name:'--'); ?></td>
                                        
                                        <td class="text-center">
                                            <form action="">
                                                <?php echo csrf_field(); ?>
                                                <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>

                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($users->links()); ?>

                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->


    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>

</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('../layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/crud-app/resources/views/users/index.blade.php ENDPATH**/ ?>