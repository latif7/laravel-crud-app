<?php

namespace App\DataTables;

use App\Models\Report;
use App\User;
use Yajra\DataTables\Services\DataTable;

class ReportDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        return datatables($this->query())
            ->addColumn('action', 'reportdatatable.action');
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Report::take(10);
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
//                    ->addAction(['width' => '80px'])
            ->parameters([
                'paging' => true,
                "pagingType" => "full_numbers",
                //'dom'     => 'Bfrtip', // simple
                'dom'     => '<"clearfix" B>lfrtip',
                'order'   => [[0, 'desc']],
                'scrollX' => true,
                'buttons' => [
                    'excel'
                ],
            ]);
//                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'msisdn',
            'sms_body',
            'shortcode',
            'request_time',
            'response_code'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Report_' . date('YmdHis');
    }
}
