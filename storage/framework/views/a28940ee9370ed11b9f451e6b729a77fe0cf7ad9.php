<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

        </h1>
        <ol class="breadcrumb">

        </ol>
    </section>

    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Month Wise Report (Last 1 Year)</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>

                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart text-center " id="bar-chart" style="height: 300px;">No Recode Found</div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>
        <!-- /.row -->


    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets')); ?>/bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/bower_components/morris.js/morris.min.js"></script>
    <script>
        // LINE CHART
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
            <?php if($reports): ?>
                var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data: [
                            <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        {y: '<?php echo e($report->requestDate); ?>', a:'<?php echo e($report->totalValid); ?>', b:'<?php echo e($report->totalInvalid); ?>', c:'<?php echo e(($report->totalValid + $report->totalInvalid)); ?>'},

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ],
                    barColors: ['#3e74f5','#00a65a','#f56954' ],
                    xkey: 'y',
                    ykeys: ['c', 'a','b'],
                    labels: ['Total', 'Valid', 'Invalid']
                });
            <?php endif; ?>

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/crud-app/resources/views/dashboard.blade.php ENDPATH**/ ?>