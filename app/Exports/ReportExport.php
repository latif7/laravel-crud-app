<?php

namespace App\Exports;

use App\Models\Report;
use http\Env\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements FromCollection, WithHeadings, WithMapping
{

    /**
     * @var Report
     */
    private $data;

    public function __construct($report)
    {
        $this->data = $report;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ['Customer Phone', 'Account Number', 'Name', 'Referred Phone','Product', "Date" ];
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {


        return [
            $row->c_phone,
            $row->account_number,
            $row->name,
            $row->r_phone,
            $row->product,
            $row->created_at,
        ];
    }
}
