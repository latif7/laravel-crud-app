<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Report Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="apple-touch-icon" href="<?php echo e(asset('assets/img')); ?>/favicon.ico">

    <link rel="shortcut icon" href="<?php echo e(asset('assets/img')); ?>/favicon.ico">
    <link rel="stylesheet" href="<?php echo e(asset('assets')); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets')); ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('assets')); ?>/bower_components/Ionicons/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo e(asset('assets')); ?>/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets')); ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets')); ?>/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo e(asset('assets')); ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets')); ?>/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo e(asset('assets')); ?>/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets')); ?>/bower_components/morris.js/morris.css">
    <style>
        .datepicker{
            z-index: 999999999 !important;
        }
        .table td.demo {
            max-width: 177px;
        }
        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            white-space: nowrap;
            max-width: 100%;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="<?php echo e(route('dashboard')); ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>SCB</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>CRUD-APP</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo e(asset('assets')); ?>/img/avatar.png" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo e(auth()->user()->name); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo e(asset('assets')); ?>/img/avatar.png" class="img-circle" alt="User Image">

                                <p>
                                    <?php echo e(auth()->user()->name); ?>

                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo e(route('users.change-password')); ?>" class="btn btn-primary btn-flat">Change Password</a>
                                </div>
                                <div class="pull-right">
                                    <form action="<?php echo e(route('logout')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-default btn-flat">Logout</button>
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>

        </nav>
    </header>

    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="<?php echo e((request()->is('dashboard')) ? 'active' : ''); ?> menu-open">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="treeview <?php echo e((request()->is('report') || request()->is('summery-report')) ? 'mennu-open active' : ''); ?>">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Report</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu <?php echo e((request()->is('report-details') || request()->is('summery-report')) ? 'show' : ''); ?>">
                        <li class="<?php echo e((request()->is('report')) ? 'active' : ''); ?>" ><a href="<?php echo e(route('report-details')); ?>"><i class="fa fa-circle-o"></i> Details</a></li>
                        <li class="<?php echo e((request()->is('summery-report')) ? 'active' : ''); ?>"><a href="<?php echo e(route('summery-report')); ?>"><i class="fa fa-circle-o"></i> Summery</a></li>

                    </ul>
                </li>
                <?php if(auth()->user()->hasRole('admin')): ?>
                    <li class="<?php echo e((request()->is('users*')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('users.index')); ?>">
                            <i class="fa fa-users"></i> <span>Manage Users</span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php if(Session::has('accessDenied')): ?>
        <section class="content-header">
            <div class="row">
                <div class="col-md-12">

                    <br>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <?php echo e(Session::get('accessDenied')); ?>

                    </div>

                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">

        </div>
        <strong>Copyright &copy; <?php echo e(\Carbon\Carbon::now()->format('Y') . "-" . (\Carbon\Carbon::now()->format('Y')+1)); ?> <a href="https://sslwireless.com/" target="__blank">SSL Wireless</a>.</strong> All rights
        reserved.
    </footer>

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo e(asset('assets')); ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('assets')); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo e(asset('assets')); ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('assets')); ?>/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('assets')); ?>/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo e(asset('assets')); ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo e(asset('assets')); ?>/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="<?php echo e(asset('assets')); ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo e(asset('assets')); ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo e(asset('assets')); ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo e(asset('assets')); ?>/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo e(asset('assets')); ?>/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo e(asset('assets')); ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- ChartJS -->

<!--  dashboard demo (This is only for demo purposes) -->

<!--  for demo purposes -->
<script src="<?php echo e(asset('assets')); ?>/js/demo.js"></script>

<?php echo $__env->yieldContent('scripts'); ?>

<!-- page script -->
<script>

</script>

</body>
</html>
<?php /**PATH /var/www/html/crud-app/resources/views/layouts/admin_master.blade.php ENDPATH**/ ?>