<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SCB Report Panel</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="apple-touch-icon" href="{{ asset('assets/img') }}/favicon.ico">

    <link rel="shortcut icon" href="{{ asset('assets/img') }}/favicon.ico">
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/bower_components/morris.js/morris.css">
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
        <a href="{{ route('dashboard') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>SCB</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SCB Report Panel</b></span>
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
                            <img src="{{ asset('assets') }}/img/avatar.png" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('assets') }}/img/avatar.png" class="img-circle" alt="User Image">

                                <p>
                                    {{ auth()->user()->name }}
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('users.change-password') }}" class="btn btn-primary btn-flat">Change Password</a>
                                </div>
                                <div class="pull-right">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
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
                <li class="{{ (request()->is('dashboard')) ? 'active' : '' }} menu-open">
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="treeview {{ (request()->is('report') || request()->is('summery-report')) ? 'mennu-open active' : '' }}">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Report</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu {{ (request()->is('report-details') || request()->is('summery-report')) ? 'show' : '' }}">
                        <li class="{{ (request()->is('report')) ? 'active' : '' }}" ><a href="{{ route('report-details') }}"><i class="fa fa-circle-o"></i> Details</a></li>
                        <li class="{{ (request()->is('summery-report')) ? 'active' : '' }}"><a href="{{ route('summery-report') }}"><i class="fa fa-circle-o"></i> Summery</a></li>

                    </ul>
                </li>
                @if(auth()->user()->hasRole('admin'))
                    <li class="{{ (request()->is('users*')) ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-users"></i> <span>Manage Users</span>
                        </a>
                    </li>
                @endif

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(Session::has('accessDenied'))
        <section class="content-header">
            <div class="row">
                <div class="col-md-12">

                    <br>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {{ Session::get('accessDenied') }}
                    </div>

                </div>
            </div>
        </section>
        @endif

        @yield('content')

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">

        </div>
        <strong>Copyright &copy; {{ \Carbon\Carbon::now()->format('Y') . "-" . (\Carbon\Carbon::now()->format('Y')+1) }} <a href="https://sslwireless.com/" target="__blank">SSL Wireless</a>.</strong> All rights
        reserved.
    </footer>

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('assets') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('assets') }}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets') }}/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('assets') }}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="{{ asset('assets') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ asset('assets') }}/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
{{--datatable--}}
<script src="{{ asset('assets') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{ asset('assets') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{ asset('assets') }}/bower_components/moment/min/moment.min.js"></script>
<script src="{{ asset('assets') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('assets') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- ChartJS -->
{{--<script src="{{ asset('assets') }}/bower_components/chart.js/Chart.js"></script>--}}
<!--  dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ asset('assets') }}/js/pages/dashboard2.js"></script>--}}
<!--  for demo purposes -->
<script src="{{ asset('assets') }}/js/demo.js"></script>

@yield('scripts')

<!-- page script -->
<script>

</script>

</body>
</html>
