@extends('../layouts.admin_master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SCB Report
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Report</li>
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
                    <form class="form-horizontal" method="post" id="searchForm1" action="{{ route('report-details-export') }}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputCustomerPhone" class="col-sm-2 control-label">Customer Phone</label>

                                <div class="col-sm-3">
                                    <input type="text" name="c_phone" class="form-control" id="inputCustomerPhone" placeholder="Customer Phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="accountNumber" class="col-sm-2 control-label">Account Number</label>

                                <div class="col-sm-3">
                                    <input type="text" name="account_number" class="form-control" id="accountNumber" placeholder="Account Number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputMobile" class="col-sm-2 control-label">Referred Phone</label>

                                <div class="col-sm-3">
                                    <input type="text" name="r_phone" class="form-control" id="inputRPhone" placeholder="Referred Phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputMobile" class="col-sm-2 control-label">Product</label>

                                <div class="col-sm-3">
                                    <input type="text" name="product" class="form-control" id="inputProduct" placeholder="Product">
                                </div>
                            </div>
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
                                <label class="col-lg-2 control-label">Status</label>
                                <div class="col-lg-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="1">Valid</option>
                                        <option value="0">Invalid</option>
                                    </select>
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
                        <h3 class="box-title">SCB Report</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div >

                            <table class="table table-bordered" id="reportTable" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Customer</th>
                                        <th colspan="3" class="text-center">Referred</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Status</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">Message</th>
                                        <th class="text-center" style="vertical-align: middle" rowspan="2" >Date</th>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <th>Account Number</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Product</th>
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
                url: "{!! route('report-details-datatable') !!}",
                data: function (d) {
                    d.status = $('#status').val();
                    d.c_phone = $('#inputCustomerPhone').val();
                    d.account_number = $('input[name=account_number]').val();;
                    d.r_phone = $('input[name=r_phone]').val();
                    d.product = $('input[name=product]').val();
                    d.from_date = $('input[name=from_date]').val();
                    d.to_date = $('input[name=to_date]').val();
                }
            },
           "order": [[ 2, "desc" ]],
           columnDefs: [
               { width: 100, targets: 5  },
               { width: 300, targets: 6  },
               { width: 100, targets: 7  },
           ],
           "autoWidth": false,
            columns: [
                { data: 'c_phone', name: 'c_phone' },
                { data: 'account_number', name: 'account_number' },
                { data: 'name', name: 'name' },
                { data: 'r_phone', name: 'r_phone' },
                { data: 'product', name: 'product' },
                { data: 'status', name: 'status' },
                { data: 'message', name: 'message' },
                { data: 'created_at', name: 'created_at' },

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


{{--    {!! $dataTable->scripts() !!}--}}
@endsection

