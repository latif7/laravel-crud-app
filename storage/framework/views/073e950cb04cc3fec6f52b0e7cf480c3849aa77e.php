
<?php if(Session::has('successMessage')): ?>
    <div class="alert alert-success">
        <strong>Success!</strong> <?php echo e(Session::get('successMessage')); ?>

    </div>
<?php endif; ?>

<?php if(Session::has('errorMessage')): ?>
    <div class="alert alert-danger">
        <strong>Error!</strong> <?php echo e(Session::get('errorMessage')); ?>

    </div>
<?php endif; ?>


<?php if(Session::has('accessDenied')): ?>
    <div class="alert alert-danger">
        <strong>Error!</strong> <?php echo e(Session::get('accessDenied')); ?>

    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/crud-app/resources/views/partial/alert.blade.php ENDPATH**/ ?>