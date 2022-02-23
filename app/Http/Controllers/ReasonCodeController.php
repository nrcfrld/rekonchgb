<?php

namespace App\Http\Controllers;

use App\Exports\ReasonCodeExport;
use App\Imports\ReasonCodeImport;
use App\Models\ReasonCode;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReasonCodeController extends Controller
{
    public function index_view()
    {
        return view('pages.reason-code.data', [
            'reasonCode' => ReasonCode::class
        ]);
    }

    public function export(Request $request)
    {
        return (new ReasonCodeExport())->download('reason_codes.xlsx');
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|max:10240|mimes:xls,xlsx',
            ]);

            $import = Excel::import(new ReasonCodeImport, $request->file('file'));

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
