<?php

namespace App\Exports;

use App\Models\Chargeback;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ChargebackExport extends DefaultValueBinder implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithCustomValueBinder
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Chargeback::query();
    }

    public function headings(): array
    {
        return [
            'Ref ID',
            'ARN',
            'Level',
            'Card Type',
            'Reason Code',
            'Reason Code Description',
            'Nomor Kartu',
            'Approval Code',
            'Transaction Date',
            'Amount',
            'Open Case',
            'Expired Date',
            'Merchant',
            'MID',
            'TID',
            'Status',
        ];
    }

    public function map($chargeback): array
    {
        return [
            $chargeback->ref_id,
            $chargeback->arn,
            $chargeback->level->name,
            $chargeback->principal->name,
            $chargeback->reasonCode->code,
            $chargeback->reasonCode->name,
            $chargeback->card_number,
            $chargeback->approval_code,
            $chargeback->transaction_date,
            $chargeback->amount,
            $chargeback->opencase_date,
            $chargeback->expired_date,
            $chargeback->merchant,
            $chargeback->mid,
            $chargeback->tid,
            $chargeback->status,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
