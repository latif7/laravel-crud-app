<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SummeryReportExport implements  FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
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
        return ['Date', 'Total Valid', 'Total Invalid', 'Total' ];
    }

    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->requestDate,
            $row->total_valid_refer,
            $row->total_invalid_refer,
            $row->total_valid_refer + $row->total_invalid_refer
        ];
    }
}
