@extends('layouts.admin_master')

@section('content')
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
@endsection

@section('scripts')
    <script src="{{ asset('assets') }}/bower_components/raphael/raphael.min.js"></script>
    <script src="{{ asset('assets') }}/bower_components/morris.js/morris.min.js"></script>
    <script>
        // LINE CHART
        {{--var line = new Morris.Line({--}}
        {{--    element: 'line-chart',--}}
        {{--    resize: true,--}}
        {{--    data: [--}}
        {{--        @foreach($reports as $report)--}}
        {{--        {d: '{{ $report->requestDate }}', Success:{{ $report->totalSuccess }}},--}}

        {{--        @endforeach--}}
        {{--        {d: '2019-01-01', Success:253},--}}
        {{--        {d: '2019-01-03', Success:586},--}}
        {{--        {d: '2019-01-04', Success:25},--}}
        {{--    ],--}}
        {{--    xkey: 'd',--}}
        {{--    ykeys: ['Success'],--}}
        {{--    labels: ['Success'],--}}
        {{--    lineColors: ['#3c8dbc'],--}}
        {{--    hideHover: 'auto'--}}
        {{--});--}}
            @if($reports)
                var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data: [
                            @foreach($reports as $report)
                        {y: '{{ $report->requestDate }}', a:'{{ $report->totalValid }}', b:'{{ $report->totalInvalid }}', c:'{{ ($report->totalValid + $report->totalInvalid) }}'},

                        @endforeach
                    ],
                    barColors: ['#3e74f5','#00a65a','#f56954' ],
                    xkey: 'y',
                    ykeys: ['c', 'a','b'],
                    labels: ['Total', 'Valid', 'Invalid']
                });
            @endif

    </script>

@endsection
