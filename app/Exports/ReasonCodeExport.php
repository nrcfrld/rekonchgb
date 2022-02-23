<?php

namespace App\Exports;

use App\Models\ReasonCode;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReasonCodeExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return ReasonCode::query();
    }

    public function headings(): array
    {
        return [
            'Card Type',
            'Code',
            'Name',
        ];
    }

    public function map($chargeback): array
    {
        return [
            $chargeback->principal->name,
            $chargeback->code,
            $chargeback->name,
        ];
    }
}
