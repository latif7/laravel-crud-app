<?php $__env->startSection('content'); ?>

<div class="login-box">
    <div class="login-logo">

        <a href="<?php echo e(route('login')); ?>" class="text-center"><img src="<?php echo e(asset('assets/img/scb.png')); ?>" class="img-responsive img" style="display: inline-block"></a>
    </div>
        <!-- /.login-logo -->
        <div class="login-box-body" style="background:#eee;">
            <p class="login-box-msg">Sign in to start your session</p>

            <?php if(session()->has('error')): ?>
                <p class="text-danger">
                     <?php echo e(session()->get('error')); ?>

                </p>
            <?php endif; ?>
        <form method="POST" action="<?php echo e(route('post-login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group has-feedback">
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus class="form-control" placeholder="Email" >
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" required class="form-control" placeholder="Password" >
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                <span class="invalid-feedback text-danger" role="alert">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/crud-app/resources/views/auth/login.blade.php ENDPATH**/ ?>