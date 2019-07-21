@extends('../layouts.admin_master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SCB Summery Report
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Report Summery</li>
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
                        <h3 class="box-title">Search</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" id="searchForm1" action="{{ route('summery-report-export') }}">
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                                <label for="inputPassword" class="col-sm-2 control-label">From Date</label>

                                <div class="col-sm-3">
                                    <input type="text" name="from_date" class="form-control" id="fromDate" placeholder="Form Date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-sm-2 control-label">To Date</label>

                                <div class="col-sm-3">
                                    <input type="text" name="to_date" class="form-control" id="toDate" placeholder="To Date">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="reset" class="btn btn-default">Clear</button>
                                    <button type="submit" id="searchForm" class="btn btn-primary">Search</button>
                                    <button type="submit" class="btn btn-info">Export to excel</button>
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
                        <h3 class="box-title">Month wise Summery Report</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div style="">
                            {{--                            {!! $dataTable->table() !!}--}}

                            <table class="table table-bordered" id="reportTable" style="width:100%;">
                                <thead>
                                <tr>
                                    <th>Request Date</th>
                                    <th>Total Valid</th>
                                    <th>Total Invalid</th>
                                    <th>Total</th>
                                </tr>
                                </thead>


                            </table>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    {{--    <script src="/vendor/datatables/buttons.server-side.js"></script>--}}
    <script>
        $(function() {
            var dt = $('#reportTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{!! route('summery-report-datatable') !!}",
                    data: function (d) {
                        d.from_date = $('input[name=from_date]').val();
                        d.to_date = $('input[name=to_date]').val();
                    }
                },
                columns: [
                    { data: 'requestDate', name: 'request_time','searchable':false, 'orderable':false },
                    { data: 'total_valid_refer', name: 'total_valid_refer','searchable':false, 'orderable':false },
                    { data: 'total_invalid_refer', name: 'total_invalid_refer','searchable':false, 'orderable':false },
                    { "data": null ,
                        "mRender" : function ( data, type, full ) {

                            return (Number(full['total_valid_refer']) + Number(full['total_invalid_refer'])) },name:"response_code","searchable": false,"orderable":false
                    }
                ]
            });

            $('#searchForm').on('click', function(e) {
                dt.draw();
                e.preventDefault();
            });

            $('#fromDate').datepicker({
                autoclose: true,
                format:"dd-mm-yyyy"
            })
            //Date picker
            $('#toDate').datepicker({
                autoclose: true,
                format:"dd-mm-yyyy"
            })
        });


    </script>

@endsection

