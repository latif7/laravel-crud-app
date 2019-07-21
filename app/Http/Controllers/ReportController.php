<?php

namespace App\Http\Controllers;

use App\DataTables\ReportDatatable;
use App\Exports\ReportExport;
use App\Exports\SummeryReportExport;
use App\Models\PullLog;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $tenDaysBefor = Carbon::now()->subDays(10)->format("Y-m-d");
        $oneYearBeforeDate = Carbon::now()->subMonths(12)->startOfMonth()->format("Y-m-d");

        $report = PullLog::select(
            DB::raw("DATE_FORMAT(created_at,'%Y-%m') as requestDate"),
            DB::raw("sum(CASE WHEN status = 1 THEN 1 ELSE 0 END) as  totalValid"),
            DB::raw("sum(CASE WHEN status = 0 THEN 1 ELSE 0 END) as  totalInvalid")
        )->whereDate('created_at', '>=', $oneYearBeforeDate)->orderBy('requestDate', 'asc')->groupBy('requestDate')->take(10)->get();
        return view('dashboard', ['reports' => $report]);
    }

    public function reportDataTable(Request $request)
    {
        $report = $this->filterData($request);

        return Datatables::of($report)->make(true);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportReport(Request $request)
    {
        $report = $this->filterData($request);
        return Excel::download(new ReportExport($report->get()), date("Ymd").'_report.xlsx');
    }

    private function filterData(Request $request)
    {
        $report = PullLog::query();

        if ($request->filled('c_phone')) {

            $report->where('c_phone', $request->input('c_phone'));
        }

        if ($request->filled('account_number')) {

            $report->where('account_number', $request->input('account_number'));
        }

        if ($request->filled('r_phone')) {

            $report->where('r_phone', $request->input('r_phone'));
        }

        if ($request->filled('product')) {

            $report->where('product', $request->input('product'));
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {

            $fromDate = Carbon::parse($request->from_date)->format('Y-m-d');
            $toDate = Carbon::parse($request->to_date)->format('Y-m-d');


            if ($fromDate > $toDate) {
                $tempDate = $fromDate;
                $fromDate = $toDate;
                $toDate = $tempDate;
            }

            $report->whereDate("created_at", '>=', $fromDate)->whereDate("created_at", '<=', $toDate);

        } elseif ($request->filled('from_date')) {

            $fromDate = Carbon::parse($request->from_date)->format('Y-m-d');
            $report->whereDate("created_at",  $fromDate);

        } elseif ($request->filled('to_date')) {

            $toDate = Carbon::parse($request->to_date)->format('Y-m-d');
            $report->whereDate("created_at",  $toDate);

        }

        if ($request->filled('status')) {

            $report->where('status', $request->input('status'));
        }

        return $report;
    }

    /**
     * Show the Report Details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reportDetails(Request $request)
    {
        return view('reports.report_details');
    }




    public function reportSummeryDataTable(Request $request)
    {
        $report = $this->filterSummeryData($request);
        return Datatables::of($report)->make(true);
    }

    public function reportSummery()
    {
        return view('reports.report_summery');
    }

    private function filterSummeryData(Request $request)
    {
        $report = PullLog::select(
            DB::raw("DATE_FORMAT(created_at,'%Y-%m') as requestDate"),
            DB::raw("sum(CASE WHEN status = 1 THEN 1 ELSE 0 END) as  total_valid_refer"),
            DB::raw("sum(CASE WHEN status = 0 THEN 1 ELSE 0 END) as  total_invalid_refer")
        );

        if ($request->filled('from_date') && $request->filled('to_date')) {

            $fromDate = Carbon::parse($request->from_date)->format('Y-m-d');
            $toDate = Carbon::parse($request->to_date)->format('Y-m-d');


            if ($fromDate > $toDate) {
                $tempDate = $fromDate;
                $fromDate = $toDate;
                $toDate = $tempDate;
            }

            $report->whereDate("created_at", '>=', $fromDate)->whereDate("created_at", '<=', $toDate);

        } elseif ($request->filled('from_date')) {

            $fromDate = Carbon::parse($request->from_date)->format('Y-m-d');
            $report->whereDate("created_at",  $fromDate);

        } elseif ($request->filled('to_date')) {

            $toDate = Carbon::parse($request->to_date)->format('Y-m-d');
            $report->whereDate("created_at",  $toDate);

        }
        return $report->groupBy('requestDate');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportSummeryReport(Request $request)
    {
        $report = $this->filterSummeryData($request);
//        dd($report->get());
        return Excel::download(new SummeryReportExport($report->get()), date("Ymd").'summery_report.xlsx');
    }

}
