<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CollectionExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $exportData;

    public function __construct($data)
    {
        $this->exportData = $data;
    }

    public function collection()
    {
        return collect($this->exportData);
    }

    public function headings(): array
    {
        $columns = array('Delivery No', 'Shipment No', 'Source', 'Destination', 'Transporter', 'Vehicle No', 'Vehicle Name', ' Driver Name', ' Driver Phone', 'Start Date', 'End Date');

        return $columns;
    }
}
