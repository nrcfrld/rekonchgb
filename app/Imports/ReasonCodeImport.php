<?php

namespace App\Imports;

use App\Models\Principal;
use App\Models\ReasonCode;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReasonCodeImport implements ToModel, WithHeadingRow
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

        return new ReasonCode([
            'principal_id' => $principal->id,
            'code' => $row['code'],
            'name' => $row['name']
        ]);
    }
}
