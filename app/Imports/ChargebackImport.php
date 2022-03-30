<?php

namespace App\Imports;

use App\Enums\StatusType;
use App\Models\Chargeback;
use App\Models\Level;
use App\Models\Principal;
use App\Models\ReasonCode;
use Exception;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ChargebackImport implements ToModel, WithChunkReading, WithHeadingRow, WithCalculatedFormulas, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $principal = Principal::where('name', 'like', $row['card_type'])->first();

        if (!$principal) {
            throw new Exception("Principal $row[card_type] Tidak Ada.", 401);
        }

        $level = Level::where('name', $row['level'])->first();

        if (!$level) {
            throw new Exception("Level $row[level] Tidak Ada.", 401);
        }

        if (!in_array($row['status'], StatusType::getValues())) {
            return dd($row['status']);
            // throw new Exception("Status $row[status] tidak valid, hanya diperbolehkan " . implode(', ', StatusType::getValues()), 401);
        }

        $reasonCode = ReasonCode::where([
            ['code', $row['reason_code']],
            ['principal_id', $principal->id]
        ])->first();

        if (!$reasonCode) {
            throw new Exception("Reason Code $row[reason_code] pada $principal->name Tidak Ada.", 401);
        }

        // JIKA REF ID SUDAH ADA, LAKUKAN UPDATE
        $exist = Chargeback::where([
            ["ref_id", $row['ref_id']],
            ["principal_id", $principal->id]
        ])->first();

        if ($exist) {
            $exist->update([
                'level_id' => $level->level >= $exist->level->level ? $level->id : $exist->level->level,
                'status' => $row['status'],
                'transaction_date' => $row['transaction_date'],
                'reason_code_id' => $reasonCode->id,
                'updated_by_id' => auth()->user()->id,
                'transaction_date' =>  is_int($row['transaction_date']) ? Date::excelToDateTimeObject($row['transaction_date']) : $row['transaction_date'],
                'amount' => $row['amount'],
                'opencase_date' => Date::excelToDateTimeObject($row['open_case']),
                'expired_date' => Date::excelToDateTimeObject($row['expired_date']),
                'merchant' => $row['merchant'],
                'mid' => $row['mid'],
                'tid' => $row['tid'],
                'status' => $row['status'],
                'date_on_book' => $row['tanggal_buku'],
            ]);
            return null;
        }

        // BUAT CHARGEBACK BARU
        $chargeback = new Chargeback([
            'ref_id' => $row['ref_id'],
            'arn' => $row['arn'],
            'level_id' => $level->id,
            'principal_id' => $principal->id,
            'reason_code_id' => $reasonCode->id,
            'card_number' => $row['nomor_kartu'],
            'approval_code' => $row['approval_code'],
            'transaction_date' =>  is_int($row['transaction_date']) ? Date::excelToDateTimeObject($row['transaction_date']) : $row['transaction_date'],
            'amount' => $row['amount'],
            'opencase_date' => Date::excelToDateTimeObject($row['open_case']),
            'expired_date' => Date::excelToDateTimeObject($row['expired_date']),
            'merchant' => $row['merchant'],
            'mid' => $row['mid'],
            'tid' => $row['tid'],
            'status' => $row['status'],
            'date_on_book' => $row['tanggal_buku'],
        ]);

        return $chargeback;
    }

    public function rules(): array
    {
        return [
            'arn' => 'required',
            'amount' => 'required|numeric',
            'ref_id' => 'required',
            'status' => 'required',
            'open_case' => 'required',
            'expired_date' => 'required',
            'reason_code' => 'required',
            'level' => 'required',
            'nomor_kartu' => 'required',
            'approval_code' => 'required',
            'transaction_date' => 'required',
            'status' => 'required',
            'card_type' => 'required'
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
