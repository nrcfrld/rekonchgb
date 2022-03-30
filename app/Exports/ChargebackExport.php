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

    protected $params;

    function __construct($params)
    {
        $this->params = $params;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        $chargeback = Chargeback::query();

        if ($this->params->principal_id) {
            $chargeback = $chargeback->where('principal_id', $this->params->principal_id);
        }

        if ($this->params->ref_id) {
            $chargeback = $chargeback->where('ref_id', $this->params->ref_id);
        }

        if ($this->params->card_number) {
            $chargeback = $chargeback->where('card_number', $this->params->card_number);
        }

        if ($this->params->arn) {
            $chargeback = $chargeback->where('arn', $this->params->arn);
        }

        if ($this->params->level_id) {
            $chargeback = $chargeback->where('level_id', $this->params->level_id);
        }

        if ($this->params->status) {
            $chargeback = $chargeback->where('status', $this->params->status);
        }

        if ($this->params->start_date) {
            $chargeback = $chargeback->whereDate('opencase_date', '>=', $this->params->start_date);
        }

        if ($this->params->end_date) {
            $chargeback = $chargeback->whereDate('opencase_date', '<=', $this->params->end_date);
        }

        return $chargeback;
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
            'Tanggal Buku',
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
            $this->clean($chargeback->merchant),
            $this->clean($chargeback->mid),
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

    protected function clean($string)
    {
        $string = str_replace('=', '', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}
