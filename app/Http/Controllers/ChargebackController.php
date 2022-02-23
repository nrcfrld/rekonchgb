<?php

namespace App\Http\Controllers;

use App\Enums\StatusType;
use App\Exports\ChargebackExport;
use App\Imports\ChargebackImport;
use App\Models\Chargeback;
use App\Models\Level;
use App\Models\Principal;
use App\Models\ReasonCode;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ChargebackController extends Controller
{
    public function index_view()
    {
        return view('pages.chargeback.data', [
            'chargeback' => Chargeback::class,
            'reasonCodes' => ReasonCode::with('principal')->get(),
            'levels' => Level::all(),
            'principals' => Principal::all(),
            'status' => StatusType::getValues()
        ]);
    }

    public function export(Request $request)
    {
        return (new ChargebackExport())->download('chargeback.xlsx');
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|max:10240|mimes:xls,xlsx',
            ]);

            $import = Excel::import(new ChargebackImport, $request->file('file'));

            if ($import) return redirect()->back()->with('success', "Berhasil Import");

            return redirect()->back()->withErrors([
                'msg' => 'Gagal Import'
            ]);
        } catch (Exception $error) {
            return redirect()->back()->withErrors([
                'msg' => $error->getMessage() . ", Harap Periksa Format Excel.",
            ]);
        }
    }
}
